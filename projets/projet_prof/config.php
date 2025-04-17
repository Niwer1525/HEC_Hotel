<?php 
	// Connexion à MySQL
	$servername = $_SERVER['SERVER_NAME'];
	$username = $_SERVER['DB_USER'];  
	$password = $_SERVER['DB_PASS'];
	$dbname="mschyns_$username";
	$conn=mysqli_connect($servername, $username, $password,$dbname);
	// Vérifier l'état de la connexion
	if(!$conn){
		die("Connexion non réussie : " . mysqli_connect_error());
	}
?>

