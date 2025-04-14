<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Modification d' une chambre : </title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            include_once("../../37config.php");

            if(isset($_POST["floor"]) && isset($_POST["room_type"]) && isset($_POST["id_chambre"])) {
                $floor = $_POST["floor"];
                $room_type = $_POST["room_type"];

                $sqlEdit = "UPDATE chambre SET id_type_chambre = $room_type, etage = $floor WHERE id_chambre = " . $_POST["id_chambre"];
                $succeed = mysqli_query($conn, $sqlEdit);
                if(!$succeed) die("Erreur de requête : " . mysqli_error($conn));

                mysqli_close($conn);
                header("Location: ../37admin_room.php");
                exit();
            }
        ?>
        <h1>Modification d'une chambre : </h1>
        <form name="formulaire_edit_room" action="37edit_room.php" method="post">
            <input name="id_chambre" type="hidden" value=<?php echo $_GET["id_chambre"] ?>>
            <label>
                Etage
                <input name="floor" type="number" required min="0">
            </label>
            <label>
                Type Chambre :
                <select name="room_type" required>
                    <?php
                        $sqlGet = "SELECT * FROM type_chambre";
                        $result = mysqli_query($conn, $sqlGet);
                        if(!$result) die("Erreur de requête : " . mysqli_error($conn));

                        while($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row["id_type_chambre"] . '">' . $row["nom_type"] . "(" . $row["capacite"] . "p, " . $row["prix_nuit_pers"] . "€)" . "</option>";
                        }
                        
                        mysqli_close($conn);
                    ?>
                </select>
                <button type="submit">Ajouter</button>
            </label>
        </from>
    </body>
</html>