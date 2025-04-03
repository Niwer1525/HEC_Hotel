<?php /* Connexion à la base de données */

    /* Données de connexion */
    $servername = "localhost";
    $username = "root"; // s220972
    $password = ""; // hbcrz71618
    $databasename = "s220972";

    // mysqli_connect est une fonction qui établit une connexion à un serveur MySQL
    $conn = mysqli_connect($servername, $username, $password, $databasename);

    if(!$conn) // Si la connexion échoue
        die("Connexion échouée : " . mysqli_connect_error()) // Concatenatiion incluant le message d'erreur
?>