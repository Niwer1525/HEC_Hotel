<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mes réservations</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <?php require_once '37user_navbar.php'; ?> <!-- Menu de navigation -->
        <h2>Mes réservations</h2>
        <?php
            require_once '../37config.php'; // Connexion à la base de données

            // Récupérer l'id du client connecté via la session
            $id_client = $_SESSION['user_id'];

            // Requête SQL pour récupérer les réservations de ce client
            $sql = "SELECT r.id_reservation, r.date_debut, r.date_fin, r.nbre_pers,
                        c.id_chambre, t.nom_type, t.capacite, t.prix_nuit_pers,
                        DATEDIFF(r.date_fin, r.date_debut) AS nb_nuits
                    FROM reservation r
                    JOIN chambre c ON r.id_chambre = c.id_chambre
                    JOIN type_chambre t ON c.id_type_chambre = t.id_type_chambre
                    WHERE r.id_client = $id_client
                    ORDER BY r.date_debut DESC";

            $result = mysqli_query($conn, $sql);

            // Affichage des résultats via un tableau
            echo '<table class="list">';
            echo '<tr>
                    <th>ID</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Chambre</th>
                    <th>Type chambre</th>
                    <th>Capacité</th>
                    <th>Nombre de personnes</th>
                    <th>Total (€)</th>
                </tr>';
            while ($row = mysqli_fetch_array($result)) {
                $total = $row['prix_nuit_pers'] * $row['nbre_pers'] * $row['nb_nuits'];
                echo '<tr>';
                echo '<td>'.$row['id_reservation'].'</td>';
                echo '<td>'.$row['date_debut'].'</td>';
                echo '<td>'.$row['date_fin'].'</td>';
                echo '<td>'.$row['id_chambre'].'</td>';
                echo '<td>'.$row['nom_type'].'</td>';
                echo '<td>'.$row['capacite'].'</td>';
                echo '<td>'.$row['nbre_pers'].'</td>';
                echo '<td>'.number_format($total, 2, ',', ' ').'</td>';
                echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn); // Fermer la connexion
        ?>
    </body>
</html>