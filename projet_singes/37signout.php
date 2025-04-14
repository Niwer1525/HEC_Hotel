<?php
	session_start();
	session_unset(); // Supprime toutes les variables de session
	session_destroy(); // Supprime la session elle-même
	header('Location: login.php');
	exit();
?>
