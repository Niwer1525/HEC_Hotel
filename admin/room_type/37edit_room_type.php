<?php
    require_once('../../37session_check.php');
    require_once('../../37config.php'); // On inclut le fichier de configuration pour la connexion à la base de données
    
    function closeScriptAndGoBackToParent() {
        header("Location: ../37admin_room_type.php"); // Redirection vers la page d'administration des types de chambre (Dans le dossier parent)
        exit();
    }

    function isFormComplete() { // Vérifie si le formulaire est complet, c'est-à-dire si toutes les valeurs sont présentes
        return isset($_POST["room_type_id"]) && isset($_POST["room_type"]) && isset($_POST["capacity"]) && isset($_POST["pricetag"]);
    }
    
    if(isset($_GET["id_type_chambre"])) {
        $id_type_chambre = $_GET["id_type_chambre"];
        $sqlGet = "SELECT * FROM type_chambre WHERE id_type_chambre = $id_type_chambre"; // On récupère le type de chambre à modifier

        $result = mysqli_query($conn, $sqlGet);
        if(!$result) closeScriptAndGoBackToParent(); // Si il n'y a pas de résultat, on redirige vers la page d'administration des types de chambre

        $row = mysqli_fetch_array($result);
        $nom_type = $row["nom_type"];
        $capacite = $row["capacite"];
        $prix_nuit_pers = $row["prix_nuit_pers"];

        mysqli_close($conn); // On ferme la connexion à la base de données, elle pourra être réouverte plus tard si besoin
    } else if(!isFormComplete())
        closeScriptAndGoBackToParent(); // Si aucune valeur n'est passée alors on redirige vers la page d'administration des types de chambre
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Modification du type : <?php echo $nom_type ?></title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            /* Traitement des données */
            if(isFormComplete()) {
                $id_type_chambre = mysqli_real_escape_string($conn, $_POST["room_type_id"]);
                $nom_type = mysqli_real_escape_string($conn, $_POST["room_type"]);
                $capacite = mysqli_real_escape_string($conn, $_POST["capacity"]);
                $prix_nuit_pers = mysqli_real_escape_string($conn, $_POST["pricetag"]);
    
                // On modifie le type de chambre dans la base de données
                $sqlInject = "UPDATE type_chambre SET nom_type = '$nom_type', capacite = '$capacite', prix_nuit_pers = '$prix_nuit_pers' WHERE id_type_chambre =" . $id_type_chambre;
                $succeed = mysqli_query($conn, $sqlInject);

                if(!$succeed) {
                    echo "Erreur lors de la modification du tuple dans la base de données : " . mysqli_error($conn);
                }

                mysqli_close($conn);
                closeScriptAndGoBackToParent();
            }
        ?>
        <h1>Modification du type de chambre : <?php echo $nom_type ?></h1>
        <form name="formulaire_insert_room_type" action="37edit_room_type.php" method="post"> <!-- on envoie le formulaire sur cette même page afin d'effectuer le traitement de manière plus simple -->
            <input name="room_type_id" value="<?php echo $id_type_chambre ?>" type="hidden">
            <label>
                Nom type de chambre
                <input name="room_type" type="text" required placeholder="King Size bedroom™" value="<?php echo $nom_type ?>">
            </label>
            <label>
                Capacité
                <input name="capacity" type="number" required value="<?php echo $capacite ?>">
            </label>
            <label>
                Prix d'une nuit par personne
                <input name="pricetag" type="number" required value="<?php echo $prix_nuit_pers?>">
            </label>
            <button type="submit">
                Modifier
            </button>
        </form>
    </body>
</html>
