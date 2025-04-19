<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Types chambres</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h1>Types chambres</h1>
        <?php
            $page = "admin_room_type"; // Page courante
            require_once("37admin_navbar.php");
            require_once("../37config.php");

            $sql = "SELECT * FROM type_chambre"; // Requête pour récupérer tous les types de chambre
            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo "<tr>";
                echo "<th>ID Type chambre</th>";
                echo "<th>Nom Type</th>";
                echo "<th>Capacité</th>";
                echo "<th>Prix d'une nuit par personne</th>";
                echo '<th class="data_button">
                        <a href="./room_type/37insert_room_type.php">
                            Ajouter
                            <img src="../assets/plus.png" alt="Ajouter">
                        </a>
                    </th>'; // Lien vers la page d'ajout de type de chambre
            echo "</tr>";
            if($result) { // Si on a des données (Que la requête a réussi)
                while($row = mysqli_fetch_array($result)) { // Tant qu'il y a des lignes à afficher
                    echo "<tr>";
                    echo "<td>" . $row["id_type_chambre"] . "</td>";
                    echo "<td>" . $row["nom_type"] . "</td>";
                    echo "<td>" . $row["capacite"] . "</td>";
                    echo "<td>" . $row["prix_nuit_pers"] . "</td>";
                    echo '<td class="data_button">
                        <a href="./room_type/37edit_room_type.php?id_type_chambre=' . $row["id_type_chambre"] . '">
                            Editer
                            <img src="../assets/pen.png" alt="Editer">
                        </a>
                    </td>';
                    echo '<td class="data_button">
                        <a class="danger" href="./room_type/37remove_room_type.php?id_type_chambre=' . $row["id_type_chambre"] . '">
                            Supprimer
                            <img src="../assets/trash.png" alt="Supprimer">
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