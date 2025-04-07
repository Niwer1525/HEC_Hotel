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
    <title>Modifier Contrat</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">     
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align="center"> Modifier sinistre</h2>

            <?php

                if (isset($_GET['idsinistre'])){
                    
                    require '11config.php';
                   
                    $idsinistre = $_GET['idsinistre'];
                    $sql = "SELECT * FROM sinistre WHERE idsinistre = '".$idsinistre."'";
                    $result = mysqli_query($conn,$sql);
                    $nbLignes = mysqli_num_rows($result);

                    if ($nbLignes == 0){
                        die("<center class=\"alert\">L'id sinistre '$idsinistre' n'existe pas.</center>");
                    } else {
                        $row = mysqli_fetch_array($result);
                        $montantrembourse = $row['montantrembourse'];
                        $statutsinistre = $row['statutsinistre'];
                    }
                    
                    
                    if (isset($_POST['save_btn'])){
                        $montantrembourse = $_POST['montantrembourse'];
                        $statutsinistre = $_POST['statutsinistre'];
                        
                        
                        $sqlUpdate = "UPDATE sinistre SET montantrembourse='".$montantrembourse."', statutsinistre='".$statutsinistre."' WHERE idsinistre='".$idsinistre."'";
                        
                        if (!mysqli_query($conn, $sqlUpdate)) {
                            die('Erreur:'.mysqli_error($conn));
                        }else{
                            echo "<center>Le sinistre $idsinistre a bien été clôturé.</center>";
                        }
                    }
                   
                    
                
                    echo '<form name="sinistre_update" action="11update_sinistre.php?idsinistre='.$idsinistre.'" method="post">';
                    echo '<table align="center">';
                    echo '<tr><td align=right>ID sinistre: </td><td>'.$idsinistre.'<input type="hidden" name="idsinistre" value="'.$idsinistre.'"></td></tr>'; 

                    echo '<tr><td align=right>Montant remboursé: </td><td><input type="text" name="montantrembourse" value="'.$montantrembourse.'" required></td></tr>'; 

                    echo '<tr><td align=right>Statut du sinistre: </td><td>'.$statutsinistre.'<input type="hidden" name="statutsinistre" value="'.$statutsinistre.'""></td></tr>';

                    echo '<input type="hidden" name="statutsinistre" value="cloture">';
                        
                    echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
                    echo '</table>';
                    echo '</form>';                     
                }else{  
                    
                    header('Location: 11list_sinistre.php');
                    exit();
                }
            ?>
        </div>      
    </div>
</body>
</html>
