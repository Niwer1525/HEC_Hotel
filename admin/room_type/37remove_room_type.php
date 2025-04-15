<?php
    require_once('../../37session_check.php');
    require_once('../../37config.php'); // On inclut le fichier de configuration pour la connexion à la base de données
    
    if(isset($_GET["id_type_chambre"])) {
        $id_type_chambre = $_GET["id_type_chambre"];     
        $sql = "DELETE FROM type_chambre WHERE id_type_chambre = $id_type_chambre";
        mysqli_query($conn, $sql); // On exécute la requête sans afficher ou de vérifier s'il y a des erreurs
    }

    /* Fermeture du script et redirection vers la page d'accueil */
    mysqli_close($conn);
    header("Location: ../37admin_room_type.php");
    exit();
?>