<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Statistiques</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Statistiques</h1>
        <?php
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            $type = isset($_GET['type']) ? $_GET['type'] : 'stats'; // Récupérer le type de statistiques à afficher et définir une valeur par défaut. Va permettre de savoir quel tableau afficher.
        ?>
        <ul>
            <li>
                <a href="37admin_stats.php?type=stats">Statistiques (Moyenne, Somme, Etc)</a>
            </li>
            <li>
                <a href="37admin_stats.php?type=view">Vue d'ensemble de la base de donnée</a>
            </li>
        </ul>
        <?php
            if($type == 'stats') {
                $sql = "";
                $result = mysqli_query($conn, $sql);

                echo "<table>";
                echo "<tr>";
                    echo "<th>Somme</th>";
                    echo "<th>Moyenne</th>";
                echo "</tr>";
                echo "</table>";
            } else {
                //TODO
            }

            mysqli_close($conn); // Fermer la connexion à la base de données
        ?>
    </body>
</html>