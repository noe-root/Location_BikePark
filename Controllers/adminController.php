<?php
    $uri = $_SERVER["REQUEST_URI"];
    require_once("Models/adminModel.php");

    if ($uri === "/admin") 
    {
        requireAdmin();
        $stats = getStatsAdmin($pdo);
        $template = "Views/Admin/pageAdminDashboard.php";
    }
    elseif ($uri === "/admin/utilisateurs") 
    {
        requireAdmin();
        if (isset($_POST["deleteClientsBatch"]) && !empty($_POST["clients"])) {
            deleteClientsBatch($pdo, $_POST["clients"]);
            header("location:/admin/utilisateurs");
            exit;
        }
        if (isset($_POST["deleteClient"])) {
            deleteClient($pdo, $_POST["client_id"]);
            header("location:/admin/utilisateurs");
            exit;
        }
        $clients = selectAllClients($pdo);
        $template = "Views/Admin/pageAdminUtilisateurs.php";
    }
    elseif ($uri === "/admin/reservations") 
    {
        requireAdmin();
        if (isset($_POST["deleteReservationsBatch"]) && !empty($_POST["reservations"])) {
            deleteReservationsBatch($pdo, $_POST["reservations"]);
            header("location:/admin/reservations");
            exit;
        }
        if (isset($_POST["updateStatut"])) {
            updateReservationStatut($pdo, $_POST["reserve_ID"], $_POST["reserve_statut"]);
            header("location:/admin/reservations");
            exit;
        }
        if (isset($_POST["deleteReservation"])) {
            deleteReservation($pdo, $_POST["reserve_ID"]);
            header("location:/admin/reservations");
            exit;
        }
        $reservations = selectAllReservations($pdo);
        $template = "Views/Admin/pageAdminReservations.php";
    }
    elseif ($uri === "/admin/materiels") 
    {
        requireAdmin();
        if (isset($_POST["toggleDispo"])) {
            updateMaterielDisponibilite($pdo, $_POST["materiel_ID"], $_POST["materiel_disponibilite"]);
            header("location:/admin/materiels");
            exit;
        }
        if (isset($_POST["deleteMateriel"])) {
            deleteMateriel($pdo, $_POST["materiel_ID"]);
            header("location:/admin/materiels");
            exit;
        }
        $materiels = selectAllMaterielAdmin($pdo);
        $template = "Views/Admin/pageAdminMateriels.php";
    }
    elseif ($uri === "/admin/bikepark") 
    {
        requireAdmin();
        if (isset($_POST["deleteBikepark"])) {
            deleteBikepark($pdo, $_POST["bikepark_ID"]);
            header("location:/admin/bikepark");
            exit;
        }
        $bikeparks = selectAllBikeparkAdmin($pdo);
        $template = "Views/Admin/pageAdminBikepark.php";
    }

    // ✅ Affiche base_admin.php seulement si $template est défini
    if (isset($template)) {
        require_once("Views/baseAdmin.php");
    }