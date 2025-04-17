<?php
    require ("37config.php"); //importe la base de donnée
    session_start(); // Démarre la session pour stocker les informations de l'utilisateur
    
    /* Récupère les données depuis les données stockées dans "POST" */
    $email = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if($email == "admin" && $password == "admin") { // Si l'utilisateur est admin
        $_SESSION['user'] = "admin"; // Met à jour la session avec simplement "admin"
        header("Location: admin/37admin_client.php"); // Redirige vers la page admin client
        exit(); // Terminer le script
    }
    
    /* Création d'un code SQL de vérification contenant les données récupérées du formulaire */
    $sql = "SELECT * FROM client WHERE email = '$email' AND mot_de_passe = '$password'";

    $succeed = mysqli_query($conn, $sql); // Tente d'exécuter la requête SQL
    if(!$succeed) // +/- équivalent à : $succeed == null
        echo "Erreur : " . mysqli_error($conn);
    
    mysqli_close($conn); // Fermer la connexion de la base de données AVANT de fermer le script (Et rediriger vers l'autre page) 

    if($succeed && mysqli_num_rows($succeed) > 0) { // Si la requête exist (Non null) et qu'il y a au moins une ligne de résultat
        $_SESSION['user'] = hash('sha256', $email . $password); // Mise à jour de la session avec un hash de l'email et du mot de passe
        $_SESSION['user_id'] = mysqli_fetch_assoc($succeed)['id_client']; // Récupère l'id du client connecté
        header("Location: user/37user_booking.php"); // Redirige vers la page de l'utilisateur
        exit(); // Terminer le script
    } else {
        echo "Identifiant ou mot de passe incorrect"; // Affiche un message d'erreur
        header("Refresh: 2; url=37login.php"); // Redirige vers la page de connexion après 2 secondes
        exit(); // Terminer le script
    }
?>