<?php require_once('../37session_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Admin - Réservations</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <h1>Réservations</h1>
        <?php
            $page = "admin_booking"; // Page courante
            require_once('37admin_navbar.php');
            require_once('../37config.php');

            /**
             * Ajout du formulaire de filtre pour les réservations
             */

            $idClient = null;
            if(isset($_GET["client_filtre"])){
                $idClient = $_GET["client_filtre"]; // Récupération de l'id client du filtre
            }
            
            $shouldFilterFromToday = false;
            if(isset($_GET["should_filter_from_today"]))  {
                $shouldFilterFromToday = $_GET["should_filter_from_today"];
            }

            function hasClientFilter() {
                return isset($_GET["client_filtre"]) && $_GET["client_filtre"] !== ""; // Vérifie si le filtre client est défini et non vide
            }

            function selectOption($id) {
                global $idClient; // Utilisation de la variable globale pour vérifier l'id client
                return $idClient == $id ? 'selected' : ''; // Vérifie si l'id client correspond à celui du filtre
            }

            $sql = "SELECT * FROM client";
            $result = mysqli_query($conn, $sql);
            echo '<form name="filtre" action="37admin_booking.php" method="GET" class="booking_filter">';
                echo '<label>';
                    echo "Client : ";
                    echo '<select name="client_filtre">';
                        echo '<option value="" ' . selectOption('') . '>Tous les clients</option>'; // Option pour tous les clients
                        if($result) {
                            while($row = mysqli_fetch_array($result)) {
                                $id = $row["id_client"]; // Récupération de l'id client (ici pour plus de lisibilité)
                                echo '<option value="' . $id . '"' . selectOption($id) . '>' . $row["nom_client"] . ' ' . $row["prenom"] . ' (' . $id . ')</option>';
                            }
                        }
                    echo "</select>";
                echo '</label>';
                echo '<label>';
                    echo "Date actuelle : ";
                    echo '<input name="should_filter_from_today" type="checkbox" '; 
                    if($shouldFilterFromToday) 
                        echo 'checked'; 
                    echo '>'; // Case à cocher
                echo '</label>';
                echo '<button type=submit>Appliquer les filtres</button>';
                echo '<a href="37admin_booking.php">Réinitialiser les filtres</a>'; // Ancre pour réinitialiser les filtres
            echo "</form>";
            
            /**
             * Formulaire pour nettoyer les filtres
             * TODO
             */

            /**
            * Affichage des lignes de réservation basée sur le filtre
            */
                
            $sql = "SELECT * FROM reservation"; // Requête pour récupérer toutes les réservations

            // Ajout de la jointure pour récupérer les informations sur la chambre et le client
            $sql = $sql . " LEFT JOIN chambre ON reservation.id_chambre = chambre.id_chambre";
            $sql = $sql . " LEFT JOIN type_chambre ON chambre.id_type_chambre = type_chambre.id_type_chambre";
            $sql = $sql . " LEFT JOIN client ON reservation.id_client = client.id_client";
            
            /* Conditions de filtrage */
            if(hasClientFilter()) { // Si on a un id client danss le filtre
                $sql = $sql . " WHERE reservation.id_client = " . $idClient; // On ajoute la condition pour le client
            }
            if($shouldFilterFromToday) {
                $today = date("Y-m-d");
                if(hasClientFilter()) { // Si on a un id client dans le filtre
                    $sql = $sql . " AND DATEDIFF(date_debut, '" . $today . "') >= 0"; // Utilisation de DATEDIFF pour vérifier la différence de date
                } else { // Si on n'a pas d'id client dans le filtre
                    $sql = $sql . " WHERE DATEDIFF(date_debut, '" . $today . "') >= 0"; // Ajout de la condition pour la date de début avec DATEDIFF
                }
            }

            $result = mysqli_query($conn, $sql);

            echo "<table>";
            echo "<tr>";
                echo "<th>ID Réservation</th>";
                echo "<th>Date de début</th>";
                echo "<th>Date de fin</th>";
                echo "<th>Nombre de personnes</th>";
                echo "<th>Chambre (ID Chambre, Nom du type)</th>";
                echo "<th>Client (Nom Prenom, ID Client)</th>";
            echo "</tr>";
            if($result) { // Si on a des données (Que la requête a réussi)
                while($row = mysqli_fetch_array($result)) { // Tant qu'il y a des lignes à afficher
                    echo "<tr>";
                    echo "<td>" . $row["id_reservation"] . "</td>";
                    echo "<td>" . $row["date_debut"] . "</td>";
                    echo "<td>" . $row["date_fin"] . "</td>";
                    echo "<td>" . $row["nbre_pers"] . "</td>";
                    echo "<td>" . $row["id_chambre"] . ', ' . $row["nom_type"] . "</td>";
                    echo "<td>" . $row["nom_client"] . " " . $row["prenom"] . " (" . $row["id_client"] . ")</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";

            mysqli_close($conn);
        ?>
    </body>
</html>