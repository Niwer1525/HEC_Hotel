<?php
    require_once("37config.php"); //importe la base de donnée

    /* Récupère les données depuis les données stockée dans "POST" */
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
    $town = mysqli_real_escape_string($conn, $_POST["town"]);
    $gsm = mysqli_real_escape_string($conn, $_POST["gsm"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    /* Création d'un code SQL d'insertion contenant les données récupérées du formulaire */
    $sql = "INSERT INTO client (nom_client, prenom, rue, code_postal, ville, gsm, email, mot_de_passe)
    VALUES ('$name', '$surname', '$street', '$zipcode', '$town', '$gsm', '$email', '$password')";

    $succeed = mysqli_query($conn, $sql); // Tente d'exécuter la requête SQL
    if(!$succeed) // Si la requête échoue
        echo "Erreur : " . mysqli_error($conn); // Concaténe l'erreur à la chaîne "Erreur : "

    mysqli_close($conn); // Force la fermeture de la connexion à la base de données

    header("Location: 37login.php"); // Redirige vers la page de connexion
    exit(); // Termine le script PHP
?>