<?php

function insertPaiementEtReservation($pdo) {
    try {
        $pending = $_SESSION["reservation_pending"];

        // 1. Insérer la réservation selon le type
        if ($pending["type"] === "bikepark") {
            $tarifs = ["Journée" => 35.00, "Demi-journée" => 25.00, "Soirée" => 20.00];
            $tarif  = $tarifs[$pending["park_typeBillet"]] ?? 35.00;

            $stmt = $pdo->prepare("INSERT INTO sys.bikepark 
                (park_dateEntre, park_tarifEntre, park_typeBillet, park_nombrePistes, park_statutPaiement)
                VALUES (:park_dateEntre, :park_tarifEntre, :park_typeBillet, :park_nombrePistes, :park_statutPaiement)");
            $stmt->execute([
                "park_dateEntre"      => $pending["park_dateEntre"],
                "park_tarifEntre"     => $tarif,
                "park_typeBillet"     => $pending["park_typeBillet"],
                "park_nombrePistes"   => (int) $pending["park_nombrePistes"],
                "park_statutPaiement" => "Payé",
            ]);
            $bikepark_ID = $pdo->lastInsertId();

        } else {
            $ids = $pending["materiel_IDs"] ?? [];
            if (!is_array($ids)) $ids = [$ids];
            $stmt = $pdo->prepare("INSERT INTO sys.reserve
                (client_ID, materiel_ID, bikepark_ID, reserve_date, reserve_lieu,
                 reserve_heureDebut, reserve_heureFin, reserve_statut,
                 reserve_commentaire, reserve_dateCreation)
                VALUES (:client_ID, :materiel_ID, :bikepark_ID, :reserve_date, :reserve_lieu,
                 :reserve_heureDebut, :reserve_heureFin, :reserve_statut,
                 :reserve_commentaire, NOW())");
            foreach ($ids as $materielId) {
                $stmt->execute([
                    "client_ID"          => (int) $_SESSION["user"]->client_ID,
                    "materiel_ID"        => (int) $materielId,
                    "bikepark_ID"        => (int) $pending["bikepark_ID"],
                    "reserve_date"       => $pending["reserve_date"],
                    "reserve_lieu"       => $pending["reserve_lieu"],
                    "reserve_heureDebut" => $pending["reserve_heureDebut"],
                    "reserve_heureFin"   => $pending["reserve_heureFin"],
                    "reserve_statut"     => "Confirmée",
                    "reserve_commentaire"=> $pending["reserve_commentaire"],
                ]);
            }
            $bikepark_ID = (int) $pending["bikepark_ID"];
        }

        // 2. Insérer le paiement
        $stmt2 = $pdo->prepare("INSERT INTO sys.payer
            (client_ID, bikepark_ID, payer_montantTotal, payer_modePaiement, payer_datePaiement)
            VALUES (:client_ID, :bikepark_ID, :payer_montantTotal, :payer_modePaiement, NOW())");
        $stmt2->execute([
            "client_ID"          => (int) $_SESSION["user"]->client_ID,
            "bikepark_ID"        => $bikepark_ID,
            "payer_montantTotal" => (float) $_SESSION["montant_total"],
            "payer_modePaiement" => $_POST["modePaiement"],
        ]);

        // 3. Nettoyer la session
        unset($_SESSION["reservation_pending"]);

        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function validerPaiementCarte() {
    $errors = [];

    $numero = preg_replace('/\s+/', '', $_POST["carte_numero"] ?? "");
    if (strlen($numero) !== 16 || !ctype_digit($numero)) {
        $errors["carte_numero"] = "Le numéro de carte doit contenir 16 chiffres.";
    }

    $nom = trim($_POST["carte_nom"] ?? "");
    if (empty($nom)) {
        $errors["carte_nom"] = "Le nom sur la carte est requis.";
    }

    $expiration = trim($_POST["carte_expiration"] ?? "");
    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiration)) {
        $errors["carte_expiration"] = "Format invalide. Utilisez MM/AA.";
    } else {
        [$mois, $annee] = explode("/", $expiration);
        $anneeComplete = (int)("20" . $annee);
        $moisInt = (int)$mois;
        if ($anneeComplete < (int)date("Y") || ($anneeComplete == (int)date("Y") && $moisInt < (int)date("m"))) {
            $errors["carte_expiration"] = "Votre carte est expirée.";
        }
    }

    $cvv = trim($_POST["carte_cvv"] ?? "");
    if (!preg_match('/^\d{3}$/', $cvv)) {
        $errors["carte_cvv"] = "Le CVV doit contenir 3 chiffres.";
    }
    return $errors;
}
