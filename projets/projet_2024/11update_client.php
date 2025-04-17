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
    <title>Modifier Client</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">  
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align="center"> Modifier Client</h2>

            <?php
                
                if (isset($_GET['idclient'])){
                     
                    require_once '11config.php';
                    
                    $idclient = $_GET['idclient'];
                    $sql = "SELECT * FROM client WHERE idclient = '" . $idclient . "'";
                    $result = mysqli_query($conn,$sql);
                    $nbLignes = mysqli_num_rows($result);

                    if ($nbLignes == 0){
                        die("<center class=\"alert\">L\'idclient '$idclient' n'existe pas.</center>");
                    } else {
                        $row = mysqli_fetch_array($result);
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        $rue = $row['rue'];
                        $codepostal = $row['codepostal'];
                        $ville = $row['ville'];
                        $gsm = $row['gsm'];
                        $email = $row['email'];
                    }
                    
                    
                    if (isset($_POST['save_btn'])){
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $rue = $_POST['rue'];
                        $codepostal = $_POST['codepostal'];
                        $ville = $_POST['ville'];
                        $gsm = $_POST['gsm'];
                        $email = $_POST['email'];
                        
                        if ($nom == '' || $prenom == '' || $rue == '' || $codepostal == '' || $ville == '' || $gsm == '' ||  $email == ''){
                            echo '<center class="alert">Nom, prénom, rue, code postal, ville, GSM et email ne peuvent pas être vides.</center><br>';
                        }else{
                            $sqlUpDate = "UPDATE client SET nom='".$nom."', prenom='".$prenom."', rue='".$rue."', codepostal='".$codepostal."', ville='".$ville."', email='".$email."', GSM='".$gsm."' WHERE idclient='".$idclient."'";
                            if (!mysqli_query($conn, $sqlUpDate)) {
                                die('Erreur:'.mysqli_error($conn));
                            }else{
                                echo "<center>Client $idclient a été modifié dans la base de données.</center>";
                            }
                        }
                    }
                    
                    
                    echo '<form name="client_update" action="11update_client.php?idclient='.$idclient.'" method="post">';
                    echo '<table align="center">';
                    echo '<tr><td align=right>idclient: </td><td>'.$idclient.'<input type="hidden" name="matricule" value="'.$idclient.'"></td></tr>'; 
                    echo '<tr><td align=right>Nom: </td><td><input type="text" name="nom" value="'.$nom.'"></td></tr>'; 
                    echo '<tr><td align=right>Prénom: </td><td><input type="text" name="prenom" value="'.$prenom.'"></td></tr>';
                    echo '<tr><td align=right>rue: </td><td><input type="text" name="rue" value="'.$rue.'">';
                    echo '<tr><td align=right>codepostal: </td><td><input type="text" name="codepostal" value="'.$codepostal.'">';
                    echo '<tr><td align=right>ville: </td><td><input type="text" name="ville" value="'.$ville.'">';
                    echo '<tr><td align=right>Email: </td><td><input type="text" name="email" value="'.$email.'"></td></tr>';
                    echo '<tr><td align=right>GSM: </td><td><input type="text" name="gsm" value="'.$gsm.'"></td></tr>';          
                    echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
                    echo '</table>';
                    echo '</form>';                     
                    
                    echo '<br>';
                    echo '<br>';
                    
                    $result_contrat = mysqli_query($conn, "SELECT * FROM contrat WHERE idclient = '" . $idclient . "'");
                    echo '<table class="list" align="center">';
                    echo '<th>idcontrat</th><th>datecontrat</th><th>idclient</th><th>idtype</th>';
                    while($row_contrat = mysqli_fetch_array($result_contrat)){
                        echo '<tr class="list">';
                        echo '<td class="list" width="10%">'.$row_contrat['idcontrat'].'</a> </td>';
                        echo '<td class="list" width="40%">'.$row_contrat['datecontrat'].'</td>';
                        echo '<td class="list" width="10%">'.$row_contrat['idclient'].'</td>';
                        echo '<td class="list" width="10%">'.$row_contrat['idtype'].'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    
                    mysqli_close($conn);
                
                }else{  
                    
                    header('Location: 11list_client.php');
                    exit();
                }
            ?>
        </div>     
    </div>
</body>
</html>