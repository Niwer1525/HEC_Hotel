<?php
    require ("37config.php"); //importe la base de donnée
    
    /* Récupère les données depuis les données stockées dans "POST" */
    $email = $_POST["username"];
    $password = $_POST["password"];

    if($email == "admin" && $password == "admin") { // Si l'utilisateur est admin
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
        header("Location: 37user.php"); // Redirige vers la page de l'utilisateur
        exit(); // Terminer le script
    }
?>