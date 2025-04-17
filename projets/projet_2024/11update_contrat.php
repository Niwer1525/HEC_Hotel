<?php
    session_start();
    if (!(isset($_SESSION['username']))){
        header("Location: 11login.php");      
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier Contrat</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">     
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align="center"> Modifier Contrat</h2>

            <?php

                if (isset($_GET['idcontrat'])){
                    
                    require '11config.php';
                   
                    $idcontrat = $_GET['idcontrat'];
                    $sql = "SELECT * FROM contrat WHERE idcontrat = '".$idcontrat."'";
                    $result = mysqli_query($conn,$sql);
                    $nbLignes = mysqli_num_rows($result);

                    if ($nbLignes == 0){
                        die("<center class=\"alert\">L'id contrat '$idcontrat' n'existe pas.</center>");
                    } else {
                        $row = mysqli_fetch_array($result);
                        $datecontrat = $row['datecontrat'];
                        $idclient = $row['idclient'];
                        $idtype = $row['idtype'];
                    }
                    
                    
                    if (isset($_POST['save_btn'])){
                        $datecontrat = $_POST['datecontrat'];
                        $idclient = $_POST['idclient'];
                        $idtype = $_POST['idtype'];
                        
                        
                        $sqlUpdate = "UPDATE contrat SET datecontrat='".$datecontrat."', idclient='".$idclient."', idtype='".$idtype."' WHERE idcontrat='".$idcontrat."'";
                        
                        if (!mysqli_query($conn, $sqlUpdate)) {
                            die('Erreur:'.mysqli_error($conn));
                        }else{
                            echo "<center>Le contrat $idcontrat a bien été modifié dans la base de données.</center>";
                        }
                    }
                    
                
                    echo '<form name="contrat_update" action="11update_contrat.php?idcontrat='.$idcontrat.'" method="post">';
                    echo '<table align="center">';
                    echo '<tr><td align=right>ID Contrat: </td><td>'.$idcontrat.'<input type="hidden" name="idcontrat" value="'.$idcontrat.'"></td></tr>'; 
                    echo '<tr><td align=right>Date Contrat: </td><td><input type="date" name="datecontrat" value="'.$datecontrat.'" required></td></tr>'; 

                    echo '<tr><td align=right>Choix du Client: </td> <td><select name="idclient">';
                        

                        $sqlClient = "SELECT idclient, nom, prenom FROM client";
                        $resultClient = mysqli_query($conn, $sqlClient);

                        while($row = mysqli_fetch_array($resultClient)){

                            if ($row['idclient'] == $idclient){ 
                                echo '<option value="'.$row['idclient'].'" selected>'.$row['nom'].' '.$row['prenom'].' ('.$row['idclient'].')</option>';
                            }else{
                                echo '<option value="'.$row['idclient'].'">'.$row['nom'].' '.$row['prenom'].' ('.$row['idclient'].')</option>';
                            }
                        }
                        mysqli_close($conn);
                        
                    echo '</select></td></tr>';

                    echo '<tr><td align=right>Choix du type d\'assurance: </td> <td><select name="idtype">';
                        
                         require '11config.php';

                        $sqlTypeassurance = "SELECT idtype, nomtype, categorie FROM typeassurance";
                        $resultTypeassurance = mysqli_query($conn, $sqlTypeassurance);

                        while($row = mysqli_fetch_array($resultTypeassurance)){
                            if ($row['idtype'] == $idtype){ 

                                echo '<option value="'.$row['idtype'].'" selected>'.$row['nomtype'].' '.$row['categorie'].' ('.$row['idtype'].')</option>';
                            }else{
                                echo '<option value="'.$row['idtype'].'">'.$row['nomtype'].' '.$row['categorie'].' ('.$row['idtype'].')</option>';
                            }
                        }
                        mysqli_close($conn);
                        
                    echo '</select></td></tr>';

                    echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
                    echo '</table>';
                    echo '</form>';                     
                }else{  
                    
                    header('Location: 11list_contrat.php');
                    exit();
                }
            ?>
        </div>      
    </div>
</body>
</html>
