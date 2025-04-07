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
    <title>Insérer Client</title>
    
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align ="center"> Nouveau Client</h2> 

            
            <form name="insert_client" action="11insert_client.php" method="post">
                <table align="center" border=0>
                    <tr><td align=right>Nom </td><td><input type="text" name="nom"></td></tr>
                    <tr><td align=right>Prénom </td><td><input type="text" name="prenom"></td></tr> 
                    <tr><td align=right>Rue </td><td><input type="text" name="rue"></td></tr>
                    <tr><td align=right>Code postal </td><td><input type="text" name="codepostal"></td></tr>
                    <tr><td align=right>Ville </td><td><input type="text" name="ville"></td></tr>
                    <tr><td align=right>GSM </td><td><input type="text" name="gsm"></td></tr>
                    <tr><td align=right>Email </td><td><input type="text" name="email"></td></tr>
                    <tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>
                </table>
            </form>

            <?php
            
            if (isset($_POST['sub_btn'])){ 
                
                $nom = $_POST['nom'];
                $prenom =  $_POST['prenom'];
                $rue = $_POST['rue'];
                $codepostal = $_POST['codepostal'];
                $ville = $_POST['ville'];
                $gsm = $_POST['gsm'];
                $email = $_POST['email'];       
                
                if ($nom == '' || $prenom == '' || $rue == '' || $codepostal == '' || $ville == '' || $gsm == '' ||  $email == ''){
                    echo '<center class="alert">Nom, prénom, rue, code postal, ville, GSM et email ne peuvent pas être vides.</center><br>';
                }else{
                    
                    require_once '11config.php';          
                    
                    $sql = "INSERT INTO client ( nom, prenom, rue, codepostal,ville, gsm, email) VALUES ('$nom', '$prenom', '$rue', '$codepostal', '$ville', '$gsm','$email')";
                    $result = mysqli_query($conn,$sql); 
                    if ($result){
                        echo '<center>Client rajouté dans la base de données</center><br>';
                    } else {
                        echo '<center>'.mysqli_error($conn).'</center><br>';
                    }
                    
                       
                    mysqli_close($conn);
                }
            }
            ?>
        </div>     
    </div>