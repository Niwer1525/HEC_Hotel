<?php require_once('../../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Ajout d'une chambre</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <?php
            include_once("../../37config.php"); // Inclusion du fichier de configuration pour la connexion à la base de données

            /* Traitement des données */
            if(isset($_POST["floor"]) && isset($_POST["room_type"])) {
                $floor = $_POST["floor"];
                $room_type = $_POST["room_type"];
    
                $sqlInsert = "INSERT INTO chambre (etage, id_type_chambre) VALUES ('$floor', '$room_type')";
                $succeed = mysqli_query($conn, $sqlInsert);
    
                if(!$succeed) { // Si la requête a échoué, on affiche un message d'erreur
                    die("Erreur de requête : " . mysqli_error($conn));
                }
                
                /* Fermeture de la connexion à la base de données, redirection vers la page admin et terminaison du script */
                mysqli_close($conn);
                header("Location: ../37admin_room.php");
                exit();
            }
        ?>
        <h1>Ajout d'une chambre</h1>
        <form name="formulaire_insert_room" action="37insert_room.php" method="post">
            <label>
                Etage :
                <input name="floor" type="number" required min="0">
            </label>
            <label>
                Type Chambre :
                <select name="room_type" required>
                    <?php
                        $sqlGet = "SELECT * FROM type_chambre";
                        $result = mysqli_query($conn, $sqlGet);
                        if(!$result) die("Erreur de requête : " . mysqli_error($conn));

                        while($row = mysqli_fetch_array($result)) { // On parcourt les résultats de la requête
                            // On affiche chaque type de chambre dans une option du select
                            echo '<option value="' . $row["id_type_chambre"] . '">' . $row["nom_type"] . "(" . $row["capacite"] . "p, " . $row["prix_nuit_pers"] . "€)" . "</option>";
                        }
                        
                        mysqli_close($conn);
                    ?>
                </select>
                <button type="submit">Ajouter</button>
                <a href="../37admin_room.php">Annuler</a> <!-- Lien pour annuler l'ajout et revenir à la page admin -->
            </label>
        </form>
    </body>
</html>