<?php 
    require_once "./database/connexion.php";

    function ShowGames() {
        global $connexion;
        $req = "SELECT * FROM jeux";
        $result = $connexion->query($req);
        return $result;
    }

    