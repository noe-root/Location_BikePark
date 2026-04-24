<?php
function isAdmin() {
    return isset($_SESSION["user"]) && $_SESSION["user"]->client_login === "admin";
}
function requireAdmin() {
    if (!isAdmin()) {
        header("location:/home");
        exit;
    }
}
// ===========================
// UTILISATEURS
// ===========================
function selectAllClients($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.client ORDER BY client_ID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function deleteClient($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM sys.client WHERE client_ID = :id AND client_login != 'admin'");
        $stmt->execute(["id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteClientsBatch($pdo, $ids) {
    try {
        $ids = array_values(array_map('intval', (array)$ids));
        if (empty($ids)) return true;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("DELETE FROM sys.client WHERE client_ID IN ($placeholders) AND client_login != 'admin'");
        $stmt->execute($ids);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// ===========================
// RÉSERVATIONS
// ===========================
function selectAllReservations($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT r.*, c.client_nom, c.client_prenom,m.materiel_nom, m.materiel_type FROM sys.reserve r LEFT JOIN sys.client c ON r.client_ID = c.client_id LEFT JOIN sys.materiel m ON r.materiel_ID = m.materiel_ID ORDER BY r.reserve_dateCreation DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function updateReservationStatut($pdo, $id, $statut) {
    try {
        $stmt = $pdo->prepare("UPDATE sys.reserve SET reserve_statut = :statut WHERE reserve_ID = :id");
        $stmt->execute(["statut" => $statut, "id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteReservation($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM sys.reserve WHERE reserve_ID = :id");
        $stmt->execute(["id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteReservationsBatch($pdo, $ids) {
    try {
        $ids = array_values(array_map('intval', (array)$ids));
        if (empty($ids)) return true;
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("DELETE FROM sys.reserve WHERE reserve_ID IN ($placeholders)");
        $stmt->execute($ids);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// ===========================
// MATÉRIELS
// ===========================
function selectAllFournisseurAdmin($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT fournisseur_ID, fournisseur_nom FROM sys.fournisseur ORDER BY fournisseur_nom");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        return [];
    }
}

function insertMateriel($pdo, $data) {
    $requiredLabels = [
        'fournisseur_ID'        => 'Fournisseur',
        'materiel_nom'          => 'Nom',
        'materiel_type'         => 'Type',
        'materiel_disponibilite'=> 'Disponibilité',
        'materiel_tarifLocation'=> 'Tarif de location',
        'materiel_etatMateriel' => 'État du matériel',
    ];
    foreach ($requiredLabels as $field => $label) {
        if (!isset($data[$field]) || $data[$field] === '') {
            return "Le champ « $label » est obligatoire.";
        }
    }
    try {
        $stmt = $pdo->prepare("
            INSERT INTO sys.materiel
                (fournisseur_ID, materiel_nom, materiel_type, materiel_modele, materiel_taille,
                 materiel_disponibilite, materiel_tarifLocation, materiel_annee,
                 materiel_etatMateriel, materiel_dateDerniereRevision)
            VALUES
                (:fournisseur_ID, :materiel_nom, :materiel_type, :materiel_modele, :materiel_taille,
                 :materiel_disponibilite, :materiel_tarifLocation, :materiel_annee,
                 :materiel_etatMateriel, :materiel_dateDerniereRevision)
        ");
        $stmt->execute([
            'fournisseur_ID'               => (int)$data['fournisseur_ID'],
            'materiel_nom'                 => $data['materiel_nom'],
            'materiel_type'                => $data['materiel_type'],
            'materiel_modele'              => $data['materiel_modele'] ?: null,
            'materiel_taille'              => $data['materiel_taille'] ?: null,
            'materiel_disponibilite'       => (int)$data['materiel_disponibilite'],
            'materiel_tarifLocation'       => (float)$data['materiel_tarifLocation'],
            'materiel_annee'               => $data['materiel_annee'] !== '' ? (int)$data['materiel_annee'] : null,
            'materiel_etatMateriel'        => $data['materiel_etatMateriel'],
            'materiel_dateDerniereRevision'=> $data['materiel_dateDerniereRevision'] ?: null,
        ]);
        return true;
    } catch (PDOException $e) {
        error_log("insertMateriel error: " . $e->getMessage());
        return "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer.";
    }
}

function selectAllMaterielAdmin($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.materiel ORDER BY materiel_type");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function updateMaterielDisponibilite($pdo, $id, $dispo) {
    try {
        $stmt = $pdo->prepare("UPDATE sys.materiel SET materiel_disponibilite = :dispo WHERE materiel_ID = :id");
        $stmt->execute(["dispo" => (int)$dispo, "id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteMateriel($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM sys.materiel WHERE materiel_ID = :id");
        $stmt->execute(["id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// ===========================
// BIKEPARK
// ===========================
function selectAllBikeparkAdmin($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.bikepark ORDER BY park_dateEntre DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function deleteBikepark($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM sys.bikepark WHERE bikepark_ID = :id");
        $stmt->execute(["id" => (int)$id]);
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// ===========================
// UTILISATEUR DÉTAIL (admin)
// ===========================
function selectClientById($pdo, $id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sys.client WHERE client_ID = :id");
        $stmt->execute(["id" => (int)$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function selectReservationsByClientAdmin($pdo, $clientId) {
    try {
        $stmt = $pdo->prepare("
            SELECT r.*, m.materiel_nom, m.materiel_type
            FROM sys.reserve r
            LEFT JOIN sys.materiel m ON r.materiel_ID = m.materiel_ID
            WHERE r.client_ID = :id
            ORDER BY r.reserve_dateCreation DESC
        ");
        $stmt->execute(["id" => (int)$clientId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function selectBikeparkByClientAdmin($pdo, $clientId) {
    try {
        $stmt = $pdo->prepare("
            SELECT p.*, b.*
            FROM sys.payer p
            LEFT JOIN sys.bikepark b ON p.bikepark_ID = b.bikepark_ID
            WHERE p.client_ID = :id
            ORDER BY p.payer_datePaiement DESC
        ");
        $stmt->execute(["id" => (int)$clientId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// ===========================
// STATS DASHBOARD
// ===========================
function getStatsAdmin($pdo) {
    try {
        $stats = [];

        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM sys.client");
        $stmt->execute();
        $stats["clients"] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM sys.reserve");
        $stmt->execute();
        $stats["reservations"] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM sys.materiel WHERE materiel_disponibilite = 1");
        $stmt->execute();
        $stats["materiels_dispo"] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM sys.bikepark");
        $stmt->execute();
        $stats["bikeparks"] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        return $stats;
    } catch (PDOException $e) {
        return ["clients" => 0, "reservations" => 0, "materiels_dispo" => 0, "bikeparks" => 0];
    }
}