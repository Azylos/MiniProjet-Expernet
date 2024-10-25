<?php
    // Inclure le fichier de connexion à la base de données et les autres dépendances nécessaires
    require_once ("../database/connexion.php");
    require_once('../database/requete.php');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si les champs obligatoires sont remplis
        if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['dateDeSortie']) && !empty($_POST['idEditeur']) && !empty($_POST['idGenre']) && !empty($_POST['tarifJeux'])) {
            // Récupérer les données du formulaire
            $idJeu = $_POST['idJeu'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $dateDeSortie = $_POST['dateDeSortie'];
            $idEditeur = $_POST['idEditeur'];
            $idGenre = $_POST['idGenre'];
            $tarifJeux = $_POST['tarifJeux'];
    
            // Appeler la procédure stockée pour mettre à jour les informations du jeu
            UpdateGame($idJeu, $titre, $description, $dateDeSortie, $idEditeur, $idGenre, $tarifJeux);
            // Redirection vers une page de confirmation ou une autre page
            header("Location: ../gestionJeux.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Certains champs obligatoires ne sont pas remplis, afficher un message d'erreur ou rediriger vers une autre page
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }
?>