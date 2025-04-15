<?php
	session_start();
	session_unset(); // Supprime toutes les variables de session (Il s'agit d'une sécurité supplémentaire)
	session_destroy(); // Supprime la session elle-même
	header('Location: index.php'); // Retour à la page d'accueil
	exit(); // Termine le script
?>