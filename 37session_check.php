<?php
    /*
        Ce fichier sera à inclure dans chaque page qui nécessite une vérification de session. (Admin ou utilisateur connecté)

        N.B : La session est un mécanisme de stockage de données côté serveur qui permet de conserver des informations 
        sur un utilisateur entre différentes pages d'un site web.
    */

    session_start(); // Démarre la session si elle n'est pas déjà démarrée

    if (!isset($_SESSION['user'])) {
        header("Location: index.php"); // Redirige vers la page de connexion (Index renvoit sur la page de connexion) si l'utilisateur est n'est pas connecté
        exit();
    }
?>