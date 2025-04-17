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
    <title>Insérer Type</title>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">
        <?php include '11menu.php'; ?>
        <div>
            <h2 align ="center">Nouveau Type d'assurance</h2> 

            <form name="insert_type" action="11insert_type.php" method="post">
                <table align="center" border=0>
                    <tr><td align=right>Nom du type</td><td><input type="text" name="nomtype" required></td></tr> 
                    
                    <tr><td align=right>catégorie</td> 
                        <td><select name="categorie"> 
                            <option value="habitation">Habitation</option>
                            <option value="auto">Auto</option>
                            <option value="rc">RC</option>
                            <option value="assistance">Assistance</option>
                        </select></td></tr>
                        <tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>
                </table>
            </form>
            
            <?php

            if (isset($_POST['sub_btn'])){

                $nomtype = $_POST['nomtype'];
                $categorie = $_POST['categorie'];

                require_once '11config.php';

                if ($nomtype == ''){
                    echo '<center class="alert">Nom du type d\'assurance ne peut pas être vide</center><br>';
            
                }else{


                $sql = "INSERT INTO typeassurance (nomtype, categorie) VALUES ('$nomtype', '$categorie')";
                }

                $result = mysqli_query($conn,$sql);
                if ($result){
                    echo '<center>Type d\'assurance rajouté dans la base de données</center><br>';
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
