<?php
    $uri = $_SERVER["REQUEST_URI"];
    require_once("Models/bikeModel.php");
    require_once("Models/paiementModel.php");

    if ($uri === "/index.php" || $uri === "/accueil" || $uri === "/home" || 
        $uri === "/index.php#services" || $uri === "/index.php#pistes" || 
        $uri === "/home#services" || $uri === "/home#pistes") 
    {
        $template = "Views/Bikes/pageAccueil.php";
    }
    elseif ($uri === "/fournisseur") 
    {
        $fournisseur = selectAllFournisseur($pdo);
        $template = "Views/Bikes/pageFournisseur.php";    
    }
    elseif ($uri === "/materiel") 
    {
        $materiel = selectAllMateriel($pdo);
        $template = "Views/Bikes/pageMateriel.php";
    }
    elseif ($uri === "/reservation-bikepark") 
    {
        if (!isset($_SESSION["user"])) {
            header("location:/connection");
            exit;
        }
        $tarifs = getTarifsBikepark();
        if (isset($_POST["reserverBikepark"])) {
            // ✅ Stockage en session sans insérer en BD
            $_SESSION["reservation_pending"] = [
                "type"             => "bikepark",
                "park_dateEntre"   => $_POST["park_dateEntre"],
                "park_typeBillet"  => $_POST["park_typeBillet"],
                "park_nombrePistes"=> $_POST["park_nombrePistes"],
            ];
            $_SESSION["montant_total"] = $tarifs[$_POST["park_typeBillet"]] ?? 35;
            header("location:/paiement");
            exit;
        }
        $template = "Views/Bikes/pageReservationBikepark.php";
    }
    elseif ($uri === "/reservation-materiel") 
    {
        if (!isset($_SESSION["user"])) {
            header("location:/connection");
            exit;
        }
        $materiels = selectAllMaterielDisponible($pdo);
        $lieux     = selectLieuxBikepark($pdo);
        if (isset($_POST["reserverMateriel"])) {
            // ✅ Stockage en session sans insérer en BD
            $ids = $_POST["materiel_ID"] ?? [];
            if (!is_array($ids)) $ids = [$ids];
            $_SESSION["reservation_pending"] = [
                "type"               => "materiel",
                "materiel_IDs"       => $ids,
                "bikepark_ID"        => $_POST["bikepark_ID"],
                "reserve_date"       => $_POST["reserve_date"],
                "reserve_lieu"       => $_POST["reserve_lieu"],
                "reserve_heureDebut" => $_POST["reserve_heureDebut"],
                "reserve_heureFin"   => $_POST["reserve_heureFin"],
                "reserve_commentaire"=> $_POST["reserve_commentaire"] ?? null,
            ];
            $intIds = array_map('intval', $ids);
            $placeholders = implode(',', array_fill(0, count($intIds), '?'));
            $stmt = $pdo->prepare("SELECT materiel_tarifLocation FROM sys.materiel WHERE materiel_ID IN ($placeholders)");
            $stmt->execute($intIds);
            $total = array_sum(array_column($stmt->fetchAll(PDO::FETCH_OBJ), 'materiel_tarifLocation'));
            $_SESSION["montant_total"] = $total;
            header("location:/paiement");
            exit;
        }
        $template = "Views/Bikes/pageReservationMateriel.php";
    }
    elseif ($uri === "/paiement")
    {
        if (!isset($_SESSION["user"])) {
            header("location:/connection");
            exit;
        }
        if (isset($_POST["payerBtn"])) {
            $mode = $_POST["modePaiement"] ?? "Carte";
            if ($mode === "Carte") {
                $messageError = validerPaiementCarte();
            } else {
                $messageError = [];
            }
            if (empty($messageError)) {
                $result = insertPaiementEtReservation($pdo);
                if ($result === true) {
                    $_SESSION["mode_paiement"] = $mode;
                    header("location:/paiement-confirmation");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
        $template = "Views/Paiement/pagePaiement.php";
    }
    elseif ($uri === "/paiement-confirmation")
    {
        if (!isset($_SESSION["user"])) {
            header("location:/connection");
            exit;
        }
        $template = "Views/Paiement/pagePaiementConfirmation.php";
    }

    // Affiche base.php seulement si $template est défini
    if (isset($template)) {
        require_once("Views/base.php");
    }