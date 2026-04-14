<?php
function selectAllFournisseur($pdo){
    try {
        $query = "SELECT * FROM sys.fournisseur";
        $selectFournisseur = $pdo->prepare($query);
        $selectFournisseur->execute();
        return $selectFournisseur->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function selectAllMateriel($pdo) {
    try {
        $query = "SELECT * FROM sys.materiel";
        $slectMateriel = $pdo->prepare($query);
        $slectMateriel->execute();
        return $slectMateriel->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function insertReservationBikepark($pdo) {
    try {
        $tarifs = [
            "Journée"=> 35.00,
            "Demi-journée" => 25.00,
            "Soirée"=> 20.00,
        ];
        $type  = $_POST["park_typeBillet"];
        $tarif = isset($tarifs[$type]) ? $tarifs[$type] : 35.00;

        $query = "INSERT INTO sys.bikepark (park_dateEntre, park_tarifEntre, park_typeBillet, park_nombrePistes, park_statutPaiement)VALUES (:park_dateEntre, :park_tarifEntre, :park_typeBillet, :park_nombrePistes, :park_statutPaiement)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            "park_dateEntre"=> $_POST["park_dateEntre"],
            "park_tarifEntre"=> $tarif,
            "park_typeBillet"=> $type,
            "park_nombrePistes"=> (int) $_POST["park_nombrePistes"],
            "park_statutPaiement"=> "Payé",
        ]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getTarifsBikepark() {
    return [
        "Journée"=> 35.00,
        "Demi-journée"=> 25.00,
        "Soirée"=> 20.00,
    ];
}

function selectAllMaterielDisponible($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.materiel WHERE materiel_disponibilite = 1 ORDER BY materiel_type");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        return [];
    }
}

function selectAllBikepark($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.bikepark ORDER BY bikepark_ID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        return [];
    }
}

function selectLieuxBikepark($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT DISTINCT reserve_lieu FROM sys.reserve ORDER BY reserve_lieu");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        return [
            (object)["reserve_lieu" => "BikePark Les 2 Alpes"],
            (object)["reserve_lieu" => "BikePark Morzine"],
            (object)["reserve_lieu" => "BikePark Tignes"],
        ];
    }
}