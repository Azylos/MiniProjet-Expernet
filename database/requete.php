<?php 
    require_once('T:/Expernet/miniProjet/25.10.2024/database/connexion.php');

    function ShowGames() {
        global $connexion;
        $req = "SELECT * FROM jeux";
        $result = $connexion->query($req);
        return $result;
    }

    function ShowGamesId($id) {
        global $connexion;
        $req = "SELECT * FROM vue_jeux_details WHERE JeuxID = $id";
        $result = $connexion->query($req);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function displayGame() {
        global $connexion;
        $req = "SELECT JeuxID, Titre, Image, Genre, Tarif FROM vue_jeux_details";
        $result = $connexion->query($req);
        return $result;
    }

    function InWishlist($idUtilisateur, $idJeux) {
        global $connexion;
        $req = "SELECT COUNT(*) AS count FROM vouloir WHERE IdUtilisateurs = $idUtilisateur AND IdJeux = $idJeux";
        $result = $connexion->query($req);
        
        if ($result && $result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = intval($row['count']);
            return $count > 0; // Renvoie vrai si une correspondance est trouvée, sinon faux
        } else {
            return false; // Renvoie faux si une erreur s'est produite ou si aucune correspondance n'a été trouvée
        }
    }

    function AddGame($idEditeur, $idGenre, $titre, $description, $dateDeSortie, $image) {
        global $connexion;
        $req = "INSERT INTO jeux (IdEditeur, IdGenre, titre, description, dateDeSortie, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(1, $idEditeur, PDO::PARAM_INT);
        $stmt->bindParam(2, $idGenre, PDO::PARAM_INT);
        $stmt->bindParam(3, $titre, PDO::PARAM_STR);
        $stmt->bindParam(4, $description, PDO::PARAM_STR);
        $stmt->bindParam(5, $dateDeSortie, PDO::PARAM_STR);
        $stmt->bindParam(6, $image, PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result) {
            // Récupérer l'ID du dernier jeu inséré
            $lastInsertedId = $connexion->lastInsertId();
            return $lastInsertedId;
        } else {
            return false;
        }
    }
    
    function UpdateGame($idJeu, $titre, $description, $dateDeSortie, $idEditeur, $idGenre, $tarifJeux) {
        global $connexion;
        $stmt = $connexion->prepare("CALL ModifierJeu(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $idJeu, PDO::PARAM_INT);
        $stmt->bindParam(2, $titre, PDO::PARAM_STR);
        $stmt->bindParam(3, $description, PDO::PARAM_STR);
        $stmt->bindParam(4, $dateDeSortie, PDO::PARAM_STR);
        $stmt->bindParam(5, $idEditeur, PDO::PARAM_INT);
        $stmt->bindParam(6, $idGenre, PDO::PARAM_INT);
        $stmt->bindParam(7, $tarifJeux, PDO::PARAM_STR);
        $stmt->execute();
    }
    
    function DeleteGame($id) {
        global $connexion;
        $req = "DELETE FROM jeux WHERE id = $id";
        $result = $connexion->exec($req);
        return $result;
    }

    function ShowEditor() {
        global $connexion;
        $editeurs = [];
        $req = "SELECT * FROM editeur";
        $result = $connexion->query($req);
        if ($result) {
            while ($row = $result->fetch()) {
                $editeurs[] = $row;
            }
        }
        return $editeurs;
    }

    //genre

    function ShowGenre() {
        global $connexion;
        $genres = [];
        $req = "SELECT * FROM genre";
        $result = $connexion->query($req);
        if ($result) {
            while ($row = $result->fetch()) {
                $genres[] = $row;
            }
        }
        return $genres;
    }

    function AddPrice($id, $tarif) {
        global $connexion;
        $req = "INSERT INTO tarif (id, dateDebut, dateFin, tarif) VALUES ($id, CURDATE(), NULL, $tarif)";
        $result = $connexion->exec($req);
        return $result;
    }