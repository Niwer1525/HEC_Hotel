<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <title>Mon compte</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h2>Mon compte</h2>
        <?php
            $page = "user_account";
            require_once '37user_navbar.php';
            require_once '../37config.php';

            if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["street"]) && isset($_POST["zipcode"]) && isset($_POST["town"]) && isset($_POST["gsm"]) && isset($_POST["password"])) {
                $name = mysqli_real_escape_string($conn, $_POST["name"]);
                $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $street = mysqli_real_escape_string($conn, $_POST["street"]);
                $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
                $town = mysqli_real_escape_string($conn, $_POST["town"]);
                $gsm = mysqli_real_escape_string($conn, $_POST["gsm"]);
                $password = mysqli_real_escape_string($conn, $_POST["password"]);

                $sqlInjection = "UPDATE client SET nom_client = '$name', prenom = '$surname', email = '$email',
                    rue = '$street', code_postal = '$zipcode', ville = '$town', gsm = '$gsm', mot_de_passe = '$password' WHERE id_client = " . $_SESSION['user_id'];

                mysqli_query($conn, $sqlInjection);
            }

            $sql = "SELECT * FROM client WHERE id_client = " . $_SESSION['user_id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result); // On aura qu'une seule valeur étant donné l'id unique du client
        ?>
        <form name="edition_compte" action="37user_account.php" method="POST">
            <label>
                Nom
                <input name="name" type="text" required placeholder="Doe" value="<?php echo $row['nom_client']; ?>">
            </label>
            <label>
                Prénom
                <input name="surname" type="text" required placeholder="John" value="<?php echo $row['prenom']; ?>">
            </label>
            <label>
                Adresse e-mail
                <input name="email" type="email" required placeholder="JohnDoe@dayrep.com" value="<?php echo $row['email']; ?>">
            </label>
            <label>
                Rue
                <input name="street" type="text" required placeholder="Rue, Avenue ..." value="<?php echo $row['rue']; ?>">
            </label>
            <label>
                Code postal
                <input name="zipcode" type="number" required placeholder="Entrez un code postal à 4 chiffres" value="<?php echo $row['code_postal']; ?>">
            </label>
            <label>
                Ville
                <input name="town" type="text" required value="<?php echo $row['ville']; ?>">
            </label>
            <label>
                GSM
                <input name="gsm" type="tel" required value="<?php echo $row['gsm']; ?>">
            </label>
            <label>
                Mot de passe
                <input name="password" type="password" required value="<?php echo $row['mot_de_passe']; ?>">
            </label>
            <button type="submit">
                Modifier
            </button>
        </form>
    </body>
    <?php
        mysqli_close($conn); // Fermeture de la connexion à la base de données après avoir utilisé les valeurs dans le formulaire
        exit();
    ?>
</html>