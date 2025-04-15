<!DOCTYPE html>
<html lang ="fr">
    <head>
        <title>Admin - Clients</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Clients</h1>
        <?php
            require_once("37admin_navbar.php");
            require_once("../37config.php");

            // Afficher le tableau des clients
            $sql = "SELECT * FROM client"; // Requête pour récupérer tous les clients
            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo "<tr>";
                echo "<th>Id client</th>"; // TABLE HEADER
                echo "<th>Nom</th>";
                echo "<th>Prenom</th>";
                echo "<th>Rue, Ville, Code postal</th>";
                echo "<th>GSM</th>";
                echo "<th>Email</th>";
            echo "</tr>";
            if($result) { // Si on a des données (Que la requête a réussi)
                while($row = mysqli_fetch_array($result)) { // Tant qu'il y a des lignes à afficher
                    echo "<tr>";
                    echo "<td>" . $row["id_client"] . "</td>"; // TABLE DATA
                    echo "<td>" . $row["nom_client"] . "</td>";
                    echo "<td>" . $row["prenom"] . "</td>";
                    echo "<td>" . $row["rue"] . " à " . $row["ville"] . ", " . $row["code_postal"] . "</td>";
                    echo "<td>" . $row["gsm"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";

            mysqli_close($conn); // On ferme la connexion à la base de données
        ?>
    </body>
</html>