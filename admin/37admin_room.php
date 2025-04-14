<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Chambres.exe</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Chambres</h1>
        <?php
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            echo '<a href="./room/37insert_room.php">Ajouter</a>'; // Lien vers la page d'ajout de chambre

            $sql = "SELECT * FROM chambre";
            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo "<tr>
                    <th>ID Chambre</th>
                    <th>Etage</th>
                    <th>Id Type chambre</th>
                </tr>";
            if($result) {
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id_chambre"] . "</td>"; // UNIQUE (Auto-incrémenté)
                    echo "<td>" . $row["etage"] . "</td>";
                    echo "<td>" . $row["id_type_chambre"] . "</td>";
                    echo '<a href="./room/37edit_room.php?id_chambre=' . $row["id_chambre"] . '">Editer</a>';
                    echo "</tr>";
                }
            }
            echo "</table>";
            
            mysqli_close($conn); // On ferme la connexion à la base de données
        ?>
    </body>
</html>