<?php 

    function selectUserByEmail($pdo){
        try {
            $query = "SELECT * FROM client where client_email = :client_email";
            $selectUser = $pdo->prepare($query);
            $selectUser->execute([
                "client_email" => $_POST["adressMail"]
            ]);
            $user = $selectUser->fetch();
            return $user;
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }

    function selectUserByEmailAndPassword($pdo){
        try {
            $query = "SELECT * FROM client where client_email = :client_email and client_password = :client_password";
            $selectUser = $pdo->prepare($query);
            $selectUser->execute([
                "client_email" => $_POST["adressMail"],
                "client_password" => $_POST["password"]
            ]);
            $user = $selectUser->fetch();
            return $user;
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }

    function InsertUser($pdo){
        try {
            $query = "INSERT INTO client (client_nom, client_prenom,client_email,client_telephone,client_age,client_ville,client_niveauExperience,client_abonnementActif,client_dateInscription,client_login,client_password) VALUES (:client_nom,:client_prenom,:client_email,:client_telephone,:client_age,:client_ville,:client_niveauExperience,:client_abonnementActif,:client_dateInscription,:client_login,:client_password);";
            $insertUser = $pdo->prepare($query);
            $insertUser->execute([
                "client_nom" => $_POST["nom"],
                "client_prenom" => $_POST["prenom"],
                "client_email" => $_POST["adressMail"],
                "client_telephone" => $_POST["telephone"],
                "client_age" => $_POST["age"],
                "client_ville" => $_POST["ville"],
                "client_niveauExperience" => $_POST["niveau"],
                "client_abonnementActif" => $_POST["abonement"],
                "client_dateInscription" => $_POST["dateInscription"],
                "client_login" => $_POST["login"],
                "client_password" => $_POST["password"]
            ]);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }
    function connectUser($pdo)
    {
        try {
            $query = "SELECT * FROM client where client_email = :client_email and client_password = :client_password";
            $connectUser = $pdo->prepare($query);
            $connectUser->execute([
                "client_email" => $_POST["adressMail"],
                "client_password" => $_POST["password"]
            ]);
            $user = $connectUser->fetch();
            $_SESSION["user"] = $user;
            return $user;
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        }
    }
    function updateUser($pdo)
    {
        try {
            $query = "update client set client_nom =:client_nom, client_prenom =:client_prenom, client_email =:client_email, client_telephone =:client_telephone, client_age =:client_age,client_ville =:client_ville,client_niveauExperience =:client_niveauExperience,client_abonnementActif =:client_abonnementActif,client_dateInscription =:client_dateInscription,client_password =:client_password where client_ID=:client_ID" ;
            $insertUser = $pdo->prepare($query);
            $insertUser->execute([
                "client_nom" => $_POST["nom"],
                "client_prenom" => $_POST["prenom"],
                "client_email" => $_POST["adressMail"],
                "client_telephone" => $_POST["telephone"],
                "client_age" => $_POST["age"],
                "client_ville" => $_POST["ville"],
                "client_niveauExperience" => $_POST["niveau"],
                "client_abonnementActif" => $_POST["abonement"],
                "client_dateInscription" => $_POST["dateInscription"],
                "client_password" => $_POST["password"],
                "client_ID" =>$_SESSION["user"]->client_ID,
            ]);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        } 
    }
    function deleteUser($pdo)
    {
        try {
            $query = "delete from client where client_ID= :client_ID" ;
            $insertUser = $pdo->prepare($query);
            $insertUser->execute([
                "client_ID" =>$_SESSION["user"]->client_ID,
            ]);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            die($message);
        } 
    }
    function selectReservationsByClient($pdo, $clientId) {
        try {
            $stmt = $pdo->prepare(
                "SELECT r.*, m.materiel_nom, m.materiel_type
                 FROM sys.reserve r
                 LEFT JOIN sys.materiel m ON r.materiel_ID = m.materiel_ID
                 WHERE r.client_ID = :client_ID
                 ORDER BY r.reserve_dateCreation DESC"
            );
            $stmt->execute(["client_ID" => (int)$clientId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectPaiementsByClient($pdo, $clientId) {
        try {
            $stmt = $pdo->prepare(
                "SELECT p.*, b.park_dateEntre, b.park_typeBillet, b.park_nombrePistes, b.park_statutPaiement
                 FROM sys.payer p
                 LEFT JOIN sys.bikepark b ON p.bikepark_ID = b.bikepark_ID
                 WHERE p.client_ID = :client_ID
                 ORDER BY p.payer_datePaiement DESC"
            );
            $stmt->execute(["client_ID" => (int)$clientId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function verifEmptyData(){
        foreach($_POST as $key => $value)
        {
            if ($value === "" || $value === null)
            {
                $messageError[$key] = "Votre ". $key ." est vide";
            }
        }
        if (isset($messageError)) 
        {
            return $messageError;
        }else 
        {
           return false;
        }  
    }