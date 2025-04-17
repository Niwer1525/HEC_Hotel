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
    <title>Liste - Client</title>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 
        <?php include '11menu.php'; ?>
        <div>
            <?php
                 
                require_once '11config.php';
                
                $sql = "SELECT idclient, nom, prenom, rue, codepostal, ville, gsm,email FROM client";
                $result = mysqli_query($conn,$sql); 
                
                if (mysqli_num_rows($result) > 0) {
                    
                    echo '<table class="list">';
                    echo "<th>idclient</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>rue</th>
                    <th>codepostal</th>
                    <th>ville</th>
                    <th>GSM</th>
                    <th>email</th>
                    <th></th>";
                    while($row = mysqli_fetch_array($result)) {
                        echo '<tr class="list">';
                        echo '<td class="list"><a href=11update_client.php?idclient='.$row['idclient'].'>'.$row['idclient'].'</a></td>';
                        echo '<td class="list">'.$row['nom'].'</td>';
                        echo '<td class="list">'.$row['prenom'].'</td>';
                        echo '<td class="list">'.$row['rue'].'</td>';
                        echo '<td class="list">'.$row['codepostal'].'</td>';
                        echo '<td class="list">'.$row['ville'].'</td>';
                        echo '<td class="list">'.$row['gsm'].'</td>';
                        echo '<td class="list">'.$row['email'].'</td>';

                        $sqlIdclient = "SELECT * FROM contrat WHERE idclient ='".$row['idclient']."'";
                        $resultIdclient = mysqli_query($conn,$sqlIdclient);
                        if(mysqli_num_rows($resultIdclient)==0){

                        echo '<td class="list"><a href=11delete_client.php?idclient='.$row['idclient'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';

                        } else {
                            echo '<td class="list" title="Impossible de supprimer un client affilié à un contrat."> </td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    
                    echo "0 résultat";
                }
                
                mysqli_close($conn);
            ?>
        </div>
    </div> 
</body>
</html>