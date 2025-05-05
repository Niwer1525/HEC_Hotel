<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Réservation</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../37style.css"> <!-- Ajout du fichier CSS -->
    </head>
    <body>
        <?php
            /* Traitement des données */
            require_once('../../37session_check.php'); // Vérification de la session
            require_once '../../37config.php'; // Connexion à la base de données

            if(isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['nbre_pers']) && isset($_POST['id_chambre'])) {
                $date_debut = $_POST['date_debut'];
                $date_fin = $_POST['date_fin'];
                $nbre_pers = $_POST['nbre_pers'];
                $id_chambre = $_POST['id_chambre'];

                // Requête SQL pour insérer la réservation
                $sql = "INSERT INTO reservation (id_client, id_chambre, date_debut, date_fin, nbre_pers) 
                        VALUES ('{$_SESSION['user_id']}', '$id_chambre', '$date_debut', '$date_fin', '$nbre_pers')";
                $result = mysqli_query($conn, $sql);

                header("Location: ../37user_booking.php"); // Redirection vers la page de réservation
                exit();
            }
        ?>
        <h1>Réserver une chambre</h1>
        <form name="formulaire_reservation_chambre" action="37insert_booking.php" method="POST">
            <label>
                Date de début:
                <input type="date" name="date_debut" required>
            </label>
            <label>
                Date de fin:
                <input type="date" name="date_fin" required>
            </label>
            <label>
                Nombre de personnes:
                <input type="number" name="nbre_pers" min="1" value="1" required>
            </label>
            <label>
                Chambre:
                <select name="id_chambre" required>
                    <option>Sélectionner une chambre</option>
                    <?php
                        // Requête SQL pour récupérer les chambres disponibles
                        $sql = "SELECT id_chambre, nom_type, capacite, prix_nuit_pers FROM chambre ";
                        $sql = $sql . "JOIN type_chambre ON chambre.id_type_chambre = type_chambre.id_type_chambre";
                        $result = mysqli_query($conn, $sql);
                        
                        if (!$result) {
                            die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
                        }
                        

                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="'.$row['id_chambre'].'">'.$row['nom_type'] . ' (pour ' . $row['capacite'] . ' personnes à partir de ' . $row['prix_nuit_pers'] . '€)</option>';
                        }
                    ?>
                </select>
            </label>
            <button type="submit">Réserver</button>
            <a href="../37user_booking.php">Retour</a>
        </form>
    </body>
</html>
<?php
    mysqli_close($conn); // Fermer la connexion à la base de données
    exit();
?>