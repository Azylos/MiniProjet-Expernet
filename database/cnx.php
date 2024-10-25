<?php
    session_start();	
    session_unset();
    $echec = null;
    
    if(isset($_POST['identifiant']) && isset($_POST['mdp'])){

        $id = $_POST['identifiant'];
        $mdp = $_POST['mdp'];

        require_once "./database/connexion.php";

        $VérifLog = "SELECT * FROM utilisateurs 
                     WHERE login = :identifiant AND  mdp = :mdp; ";
        
        $result = $connexion->prepare($VérifLog);
        $result->bindParam(':identifiant', $id, PDO::PARAM_STR);
        $result->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $result->execute();

        $userConnect = $result->fetch();

        if (!$userConnect) {
            $echec = "<p class='Echec'>identifiant ou mot de passe incorrects</p>";
        } else {
            if ($userConnect['estAdmin'] == 1) {
                $_SESSION['admin'] = [
                    'id' => $userConnect['id'],
                    'pseudo' => $userConnect['pseudo'],
                    'imgProfil' => $userConnect['imgProfil'],
                ];
                if (empty($_SESSION['admin']['imgProfil'])){
                    $_SESSION['admin']['imgProfil'] = "defaut.png";
                }
            } else {
                $_SESSION['user'] = [
                    'id' => $userConnect['id'],
                    'pseudo' => $userConnect['pseudo'],
                    'imgProfil' => $userConnect['imgProfil'],
                ];
                if (empty($_SESSION['user']['imgProfil'])){
                    $_SESSION['user']['imgProfil'] = "defaut.png";
                }
            }

            if(isset($_SESSION["admin"])) {
                header("Location: ./gestionJeux.php");
            } else {
                header("Location: ./index.php");
            }
        }
    } 