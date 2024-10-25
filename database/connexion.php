<?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "Rungame_Ad";
    $password = "12-Soleil&";
    $dbname = "e5_rungame";

	try {
		$connexion = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
		//Definition du mode d'erreur de PDO sur Exception
		$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	//Capture des exceptions et affichage des informations de celles-ci
	catch(PDOException $e) {
		// echo "<h4>Erreur de connexion : </h4>" .$e->getMessage();
	}		


?>