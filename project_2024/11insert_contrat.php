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
    <title>Insérer contrat</title>
    
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align ="center">Nouveau Contrat</h2> 
            <form name="insert_contrat" action="11insert_contrat.php" method="post">
                <table align="center" border=0>

                    <tr><td align=right> Choix du Client: </td> 

                        <td><select name="idclient">
                            
                            <?php 
                                
                                require '11config.php';
                                
                                $sqlClient = "SELECT idclient, nom, prenom FROM client";
                                $resultClient = mysqli_query($conn, $sqlClient);
                                
                                while($row = mysqli_fetch_array($resultClient)){
                                    echo '<option value="'.$row['idclient'].'">'.$row['nom'].' '.$row['prenom'].' ('.$row['idclient'].')</option>';
                                }
                                
                                mysqli_close($conn);
                            ?>
                        </select></td>
                    </tr>

                    <tr><td align=right> Choix du type d'assurance: </td> 

                        <td><select name="idtype">
                            
                            <?php 
                                
                                require '11config.php';
                                
                                $sqlTypeassurance = "SELECT idtype, nomtype, categorie FROM typeassurance";
                                $resultTypeassurance = mysqli_query($conn, $sqlTypeassurance);
                                
                                while($row = mysqli_fetch_array($resultTypeassurance)){
                                    echo '<option value="'.$row['idtype'].'">'.$row['nomtype'].' '.$row['categorie'].' ('.$row['idtype'].')</option>';
                                }
                                
                                mysqli_close($conn);
                            ?>
                        </select></td>
                     </tr>

                     <tr><td align=right>Montant de la premiere prime:</td><td><input type="text" name="montant"></td></tr>

                     <tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>

                </table>
            </form>

            <?php

            if (isset($_POST['sub_btn'])){

                $idclient = $_POST['idclient'];
                $idtype = $_POST['idtype'];
                $montant = $_POST['montant'];

                require '11config.php';

                if ($montant == ''){
                    echo '<center class="alert">Montant de la premiere prime ne peut pas être vide</center><br>';
            
                }else{

                $datecontrat = date("Y-m-d");

                $insertContrat="INSERT INTO contrat (datecontrat, idclient, idtype) VALUES ('$datecontrat', '$idclient', '$idtype')";
                mysqli_query($conn,$insertContrat);
                $lastid=mysqli_insert_id($conn);

                $insertPrime="INSERT INTO prime (dateprime, montant, idcontrat, statutprime) VALUES ('$datecontrat', '$montant', '$lastid', 'a payer')";
                mysqli_query($conn,$insertPrime);

                echo '<center>Contrat rajouté dans la base de données avec une nouvelle prime</center><br>';

                mysqli_close($conn);
                }
            }
            ?>
        </div>
    </div>
</body>
</html>