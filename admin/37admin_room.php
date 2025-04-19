<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Chambres.exe</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h1>Chambres</h1>
        <?php
            $page = "admin_room"; // Page courante
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            $sql = "SELECT * FROM chambre"; // Requête pour récupérer toutes les chambres
            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo '<tr>';
                    echo '<th>ID Chambre</th>';
                    echo '<th>Etage</th>';
                    echo '<th>Id Type chambre</th>';
                    echo '<th class="data_button">
                            <a href="./room/37insert_room.php">
                                Ajouter
                                <img src="../assets/plus.png" alt="Ajouter">
                            </a>
                        </th>';
                echo '</tr>';
            if($result) { // Si on a des données (Que la requête a réussi)
                while($row = mysqli_fetch_array($result)) { // Tant qu'il y a des lignes à afficher
                    echo "<tr>";
                    echo "<td>" . $row["id_chambre"] . "</td>"; // UNIQUE (Auto-incrémenté)
                    echo "<td>" . $row["etage"] . "</td>";
                    echo "<td>" . $row["id_type_chambre"] . "</td>";
                    echo '<td class="data_button">
                        <a href="./room/37edit_room.php?id_chambre=' . $row["id_chambre"] . '">
                            Editer
                            <img src="../assets/pen.png" alt="Editer">
                        </a>
                    </td>';
                    echo "</tr>";
                }
            }
            echo "</table>";
            
            mysqli_close($conn); // On ferme la connexion à la base de données
        ?>
    </body>
</html>