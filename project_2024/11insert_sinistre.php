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
    <title>Insérer sinistre</title>
    
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align ="center">Nouveau sinistre</h2> 
            <form name="insert_prime" action="11insert_sinistre.php" method="post">
                <table align="center" border=0>

                    <tr><td align=right> Choix du Contrat: </td> 

                        <td><select name="idcontrat">
                            
                            <?php 
                                
                                require '11config.php';
                                
                                $sqlContrat = "SELECT contrat.idcontrat, contrat.datecontrat, contrat.idclient, client.nom, client.prenom, typeassurance.nomtype, contrat.idtype FROM contrat, client, typeassurance WHERE contrat.idclient = client.idclient AND contrat.idtype = typeassurance.idtype";

                                $resultContrat = mysqli_query($conn, $sqlContrat);
                                
                                while($row = mysqli_fetch_array($resultContrat)){
                                    echo '<option value="'.$row['idcontrat'].'">'.Contrat.' ('.$row['idcontrat'].') '.du.' '.$row['datecontrat'].' '.de.' '.$row['nom'].' '.$row['prenom'].' ('.$row['idclient'].'), '.de.' '.type.' '.$row['nomtype'].' ('.$row['idtype'].')</option>';
                                }
                                
                                mysqli_close($conn);
                            ?>
                        </select></td>
                    </tr>

                     <tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>

                </table>
            </form>

            <?php

            if (isset($_POST['sub_btn'])){

                $idcontrat = $_POST['idcontrat'];

                require '11config.php';

                $datesinistre = date("Y-m-d");

                $sql="INSERT INTO sinistre (datesinistre, statutsinistre, montantrembourse, idcontrat) VALUES ('$datesinistre', 'en cours', '0', '$idcontrat')";

                $result = mysqli_query($conn,$sql);
                if ($result){
                    echo '<center>sinistre rajouté dans la base de données</center><br>';
                } else {
                    echo '<center>'.mysqli_error($conn).'</center><br>';
                }
                mysqli_close($conn);
            }
            
            ?>
        </div>
    </div>
</body>
</html>