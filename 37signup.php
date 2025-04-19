<?php
    session_start(); // Démarre la session si elle n'est pas déjà démarrée

    if(isset($_SESSION['user'])) { // Si la variable de session "user" est définie
        if($_SESSION['user'] == "admin") { // Si l'utilisateur est un administrateur
            header("Location: admin/37admin_client.php"); // Redirige vers la page d'administration (Liste des clients 37admin_client.php)
        } else { // Sinon, si l'utilisateur est un client
            header("Location: user/37user_booking.php"); // Redirige vers la page de l'utilisateur
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>S'enregistrer</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h1>S'enregistrer/Créer un compte</h1>
        <?php
            $page = "signup";
            require_once("37navbar.php"); //importe la barre de navigation de 37navbar.php
        ?>
        <!--
            Formulaire de création de compte
            Adresse décomposée : Rue, num maison mit à part
        -->
        <form name="formulaire_de_creation_de_compte" action="37creation_compte.php" method="post">
            <label>
                Nom d'utilisateur
                <input name="username" type="text" required placeholder="JohnDoe125">
            </label>
            <label>
                Nom
                <input name="name" type="text" required placeholder="Doe">
            </label>
            <label>
                Prénom
                <input name="surname" type="text" required placeholder="John">
            </label>
            <label>
                Adresse e-mail
                <input name="email" type="email" required placeholder="JohnDoe@dayrep.com">
            </label>
            <label>
                Adresse
                <input name="street" type="text" required placeholder="Rue, Avenue ...">
            </label>
            <label>
                Code postal
                <input name="zipcode" type="number" required placeholder="Entrez un code postal à 4 chiffres">
            </label>
            <label>
                Ville
                <input name="town" type="text" required>
            </label>
            <label>
                GSM
                <input name="gsm" type="tel" required>
            </label>
            <label>
                Mot de passe
                <input name="password" type="password" required>
            </label>
            <button type="submit">
                Créer le compte
            </button>
        </form>
    </body>
</html>