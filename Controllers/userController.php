<?php
    $uri = $_SERVER["REQUEST_URI"];
    require_once("Models/userModel.php");
    if ($uri == "/inscription") 
    {
        if (isset($_POST["envoyer"]))
        {
            $user = selectUserByEmail($pdo);
            if ($user) 
            {
                var_dump("Erreur");
            }else 
            {
                $messageError = verifEmptyData();
                if (!$messageError) 
                {
                   InsertUser($pdo);
                   header("location:/connection");                
                }  
            }               
        }
        $template = "User/userInscription.php";
    }elseif ($uri == "/connection") {
        if (isset($_POST["envoyer"]))
        {
           $user = selectUserByEmailAndPassword($pdo);
           if ($user) 
           {
                connectUser($pdo);
                header("location:/home");
           }else 
           {
                header("location:/inscription");
           }
        }
        $template = "User\userConnection.php";
    }elseif ($uri == "/deconnection") {
        if (isset($_SESSION["user"]))
        {
            session_destroy();
            header("location:/home");
        }
    }elseif ($uri == "/profil") {
        if (isset($_SESSION["user"]))
        {
            if (isset($_POST["envoyer"])) 
            {
              $messageError = verifEmptyData();
                if (!$messageError) 
                {
                    updateUser($pdo);
                    connectUser($pdo);
                    header("location:/profil");
                }    
            }   
            $template = "User/userProfil.php";
        }
    }elseif ($uri == "/deleteProfil") {
        deleteUser($pdo);
        session_destroy();
        header("location:/home");
    }