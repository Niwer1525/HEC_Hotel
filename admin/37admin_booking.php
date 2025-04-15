<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Réservations</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Réservations</h1>
        <?php
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            $sql = "SELECT * FROM reservation"; // Requête pour récupérer toutes les réservations
            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo "<tr>";
                echo "<th>ID Réservation</th>";
                echo "<th>Date de début</th>";
                echo "<th>Date de fin</th>";
                echo "<th>Nombre de personnes</th>";
                echo "<th>ID chambre</th>";
                echo "<th>ID client</th>";
            echo "</tr>";
            if($result) { // Si on a des données (Que la requête a réussi)
                while($row = mysqli_fetch_array($result)) { // Tant qu'il y a des lignes à afficher
                    echo "<tr>";
                    echo "<td>" . $row["id_reservation"] . "</td>";
                    echo "<td>" . $row["date_debut"] . "</td>";
                    echo "<td>" . $row["date_fin"] . "</td>";
                    echo "<td>" . $row["nbre_pers"] . "</td>";
                    echo "<td>" . $row["id_chambre"] . "</td>";
                    echo "<td>" . $row["id_client"] . "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";

            mysqli_close($conn);
        ?>
    </body>
</html>