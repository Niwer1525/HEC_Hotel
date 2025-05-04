<?php
    if(!isset($_GET['id_reservation'])) // Si l'id de la réservation n'est pas passé en paramètre
        die('Erreur : id_reservation manquant !'); // On arrête le script et on affiche un message d'erreur

    require_once('../../37session_check.php');
    require_once('../../37config.php'); // Connexion à la base de données

    $sql = "DELETE FROM reservation WHERE id_reservation = ".$_GET['id_reservation']; // Requête SQL pour supprimer la réservation
    $result = mysqli_query($conn, $sql); // Exécution de la requête
    if(!$result) // Si la requête échoue
        die('Erreur : '.mysqli_error($conn)); // On arrête le script et on affiche un message d'erreur

    mysqli_close($conn); // Fermer la connexion à la base de données
    header('Location: ../37user_booking.php'); // Redirection vers la page de réservation
    exit();
?>