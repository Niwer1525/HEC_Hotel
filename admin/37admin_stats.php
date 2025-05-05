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

            $type = 'chiffre_affaire'; // Valeur par défaut pour le type de statistiques
            if(isset($_GET['type'])) $type = $_GET['type']; // Récupération du type de statistiques depuis l'URL
        ?>
        <ul>
            <li>
                <a href="37admin_stats.php?type=chiffre_affaire" <?php if($type == "chiffre_affaire") echo 'class="active"'; ?>>Chiffre d'affaire</a>
            </li>
            <li>
                <a href="37admin_stats.php?type=chargesclients" <?php if($type == "chargesclients") echo 'class="active"'; ?>>Charges client</a>
            </li>
        </ul>
        <?php
            if($type == 'chiffre_affaire') {
                $sql = "SELECT
                    cl.id_client,
                    cl.nom_client,
                    cl.prenom,
                    COUNT(*) AS nb_reservations,
					SUM(DATEDIFF(r.date_fin, r.date_debut) * t.prix_nuit_pers * r.nbre_pers) AS total
					FROM client cl
					JOIN reservation r ON cl.id_client = r.id_client
					JOIN chambre ch ON r.id_chambre = ch.id_chambre
					JOIN type_chambre t ON ch.id_type_chambre = t.id_type_chambre
					GROUP BY cl.id_client";
                $result = mysqli_query($conn, $sql);

                echo "<table>";
                    echo "<tr>";
                        echo "<th>ID Client</th>";
                        echo "<th>Nom Client</th>";
                        echo "<th>Prénom Client</th>";
                        echo "<th>Nombre de réservations</th>";
                        echo "<th>Total payé (€)</th>";
                    echo "</tr>";
                if($result) { // Si il y a un résultat
                    while($row = mysqli_fetch_array($result)) { // Tant qu'on a des lignes, on affiche.
                        echo "<tr>";
                            echo '<td>'.$row['id_client'].' </td>';
                            echo '<td>'.$row['nom_client'].'</td>';
                            echo '<td>'.$row['prenom'].'</td>';
                            echo '<td>'.$row['nb_reservations'].'</td>';
                            echo '<td>'.$row['total'].'€</td>';
                        echo "</tr>";
                    }
                }
                echo "</table>";
            } else {
                $sql = "SELECT
                    COUNT(*) AS nbReservations, t.nom_type, r.nbre_pers,
                    DATEDIFF(r.date_fin, r.date_debut) AS nb_nuits,
                    t.prix_nuit_pers
                    FROM reservation r
                    JOIN chambre c ON r.id_chambre = c.id_chambre
                    JOIN type_chambre t ON c.id_type_chambre = t.id_type_chambre
                ";
                $result = mysqli_query($conn, $sql);

                echo "<table>";
                    echo "<tr>";
                        echo "<th>Nom de la chambre</th>";
                        echo "<th>Nombre de réservations</th>";
                        echo "<th>Nombre total de nuit</th>";
                        echo "<th>Montant total (€)</th>";
                    echo "</tr>";
                if($result) { // Si il y a un résultat
                    while($row = mysqli_fetch_array($result)) { // Tant qu'on a des lignes, on affiche.
                        $total = $row['prix_nuit_pers'] * $row['nbre_pers'] * $row['nb_nuits'];
                        echo '<tr>';
                            echo '<td>'.$row['nom_type'].' </td>';
                            echo '<td>'.$row['nbReservations'].'</td>';
                            echo '<td>'.$row['nb_nuits'].'</td>';
                            echo '<td>'.number_format($total,2, ',', ' ').'€</td>';
                        echo '</tr>';
                    }
                }
                echo "</table>";
            }

            mysqli_close($conn); // Fermer la connexion à la base de données
        ?>
    </body>
</html>