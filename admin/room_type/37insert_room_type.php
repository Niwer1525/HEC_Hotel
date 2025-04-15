<?php require_once('../../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Ici nous allons ajouter un type de chambre !!! (Truc de ouf je sais)</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            /* Traitement des données */
            if(isset($_POST["room_type"]) && isset($_POST["capacity"]) && isset($_POST["pricetag"])) {
                require_once('../../37config.php'); // On inclut le fichier de configuration pour la connexion à la base de données
    
                $nom_type = mysqli_real_escape_string($conn, $_POST["room_type"]);
                $capacite = mysqli_real_escape_string($conn, $_POST["capacity"]);
                $prix_nuit_pers = mysqli_real_escape_string($conn, $_POST["pricetag"]);
    
                $sql = "INSERT INTO type_chambre(nom_type, capacite, prix_nuit_pers) VALUES ('$nom_type', '$capacite', '$prix_nuit_pers')";
                $succeed = mysqli_query($conn, $sql);

                if(!$succeed) {
                    echo "Erreur lors de l'insertion dans la base de données : " . mysqli_error($conn);
                }

                mysqli_close($conn);

                header("Location: ../37admin_room_type.php"); // Redirection vers la page d'administration des types de chambre (Dans le dossier parent)
                exit();
            }
        ?>
        <h1>Ajouter un tpye de chambre</h1>
        <form name="formulaire_insert_room_type" action="37insert_room_type.php" method="post"> <!-- on envoie le formulaire sur cette même page afin d'effectuer le traitement de manière plus simple -->
            <label>
                Nom type de chambre
                <input name="room_type" type="text" required placeholder="King Size bedroom™">
            </label>
            <label>
                Capacité
                <input name="capacity" type="number" required>
            </label>
            <label>
                Prix d'une nuit par personne
                <input name="pricetag" type="number" required>
            </label>
            <button type="submit">
                Créer le type de chambre
            </button>
        </form>
    </body>
</html>
