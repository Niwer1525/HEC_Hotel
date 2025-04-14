<?php
    /*
        Ce fichier sera à inclure dans chaque page qui nécessite une vérification de session. (Admin ou utilisateur connecté)
    */

    session_start(); // Démarre la session si elle n'est pas déjà démarrée

    // if (!isset($_SESSION[''])) {
    //     header("Location: index.php"); // Redirige vers la page d'accueil si l'utilisateur est déjà connecté
    //     exit();
    // }

    /* 
        TODO il faut aussi ajouter des vérifications sur la page de connexion pour ne pas forcer un utilisateur à se reconnecer (Admin/Client connecté)
    */
?>