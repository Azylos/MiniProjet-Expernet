<?php
    require_once ("../database/requete.php");

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $idJeu = $_GET['id'];

        
        $supJeux = DeleteGame($idJeu);

        if ($supJeux) {
            echo "Le jeu a été supprimé avec succès.";
        }else {
            echo "Une erreur s'est produite lors de la suppression du jeu.";
        }

        header("Location: ../gestionJeux.php");
        exit();
    }
?>
