<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title> <!-- Titre de l'onglet de la page -->
        <meta charset="utf-8"> <!-- Encodage -->
    </head>
    <body>
        <h1>Se connecter</h1>
        <?php
            require_once("37navbar.php"); //importe la barre de navigation de 37navbar.php
        ?>
        <!-- Formulaire "se connecter". -->
        <form name="formulaire_se_connecter" action="page_de_gestion_serveur.php" method="post"> <!-- !!! page_de_gestion_serveur.php n'existe pas encore -->
            <label>
                Nom d'utilisateur
                <input name="username" type="text" required placeholder="JohnDoe125">
            </label>
            <label>
                Mot de passe
                <input name="password" type="password" required>
            </label>
            <button type="submit">
                Envoyer
            </button>
        </form>
    </body>
</html>