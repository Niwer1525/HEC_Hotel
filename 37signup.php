<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>S'enregistrer</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>S'enregistrer/Créer un compte</h1>
        <?php
            require_once("37navbar.php"); //importe la barre de navigation de 37navbar.php
        ?>
        <!--
            Formulaire de création de compte
            Adresse décomposée : Rue, num maison mit à part
        -->
        <form name="formulaire_de_creation_de_compte" action="page_de_gestion_serveur.php" method="post"> <!-- !!! page_de_gestion_serveur.php n'existe pas encore -->
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
                Numéro de maison
                <input name="housenumber" type="number" required placeholder="Numéro de maison">
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