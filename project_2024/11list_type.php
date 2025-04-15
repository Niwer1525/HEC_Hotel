<?php 
    session_start();
    if (!isset($_SESSION['username'])){
    	header("Location: 11login.php");
    	exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Liste - Type d'assurance </title>
        <meta charset="utf-8">
        <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">
        <?php include '11menu.php'; ?>
        <div>
            <?php
                require_once '11config.php';

                $sql = "SELECT idtype, nomtype, categorie FROM typeassurance";
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0) {

                    echo '<table class="list">';
                    echo "<th>idtype</th>
                    <th>Nom du type</th>
                    <th>Catégorie</th>";

                    while($row = mysqli_fetch_array($result)){
                        echo '<tr class="list">';
                        echo '<td class="list"><a href=11update_type.php?idtype='.$row['idtype'].'>'.$row['idtype'].'</a></td>';
                        echo '<td class="list">'.$row['nomtype'].'</td>';
                        echo '<td class="list">'.$row['categorie'].'</td>';

                        $sqlIdtype = "SELECT * FROM contrat WHERE idtype ='".$row['idtype']."'";
                        $resultIdtype = mysqli_query($conn,$sqlIdtype);
                        if(mysqli_num_rows($resultIdtype)==0){

                        echo '<td class="list"><a href=11delete_type.php?idtype='.$row['idtype'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';

                         } else {
                            echo '<td class="list" title="Impossible de supprimer un type d\'assurance affilié à un contrat."> </td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }else {

                    echo "0 résultat";
                }

                mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>