<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Statistiques</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h1>Statistiques</h1>
        <?php
            $page = "admin_stats"; // Page courante
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            $type = isset($_GET['type']) ? $_GET['type'] : 'chiffre_affaire'; // Récupérer le type de statistiques à afficher et définir une valeur par défaut. Va permettre de savoir quel tableau afficher.
        ?>
        <ul>
            <li>
                <a href="37admin_stats.php?type=chiffre_affaire">Chiffre d'affaire</a>
            </li>
            <li>
                <a href="37admin_stats.php?type=view">Vue d'ensemble de la base de donnée</a>
            </li>
        </ul>
        <?php
            if($type == 'chiffre_affaire') {
                $sql = "SELECT sum(nbre_pers) AS 'nbreTotalPersonnes', count(id_reservation) AS nbreReservation FROM reservation";
                $result = mysqli_query($conn, $sql);

                echo "<table>";
                    echo "<tr>";
                        echo "<th>Nombre total de personnes</th>";
                        echo "<th>Moyenne</th>";
                        echo "<th>Nombre de réservations</th>";
                    echo "</tr>";
                if($result) { // Si il y a un résultat
                    while($row = mysqli_fetch_array($result)) { // Tant qu'on a des lignes, on affiche.
                        echo "<tr>";
                            echo "<td>" . $row['nbreTotalPersonnes'] . "</td>";
                            echo "<td>" . "</td>";
                            echo "<td>" . $row['nbreReservation'] . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            } else {
                $sql = "";
                $result = mysqli_query($conn, $sql);

                echo "<table>";
                    echo "<tr>";
                        echo "<th>Nombre total de personnes</th>";
                        echo "<th>Moyenne</th>";
                        echo "<th>Nombre de réservations</th>";
                    echo "</tr>";
                if($result) { // Si il y a un résultat
                    while($row = mysqli_fetch_array($result)) { // Tant qu'on a des lignes, on affiche.
                    }
                }
                echo "</table>";
            }

            mysqli_close($conn); // Fermer la connexion à la base de données
        ?>
    </body>
</html>