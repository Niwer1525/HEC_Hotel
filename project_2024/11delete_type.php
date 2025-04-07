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
    <title>Supprimer Type d'assurance</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">    
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align ="center">Suppression du type d'assurance</h2>
            <?php
                
                if (isset($_GET['idtype'])){
                     
                    require_once '11config.php';
                   
                    $sql = "DELETE FROM typeassurance where idtype='".$_GET['idtype']."'";
                    $result = mysqli_query($conn,$sql); 
                    if ($result){
                        if(mysqli_affected_rows($conn)>0) {
                            echo '<center>Type d\'assurance '.$_GET['idtype'].' supprimé de la base de données</center><br>';
                        }else{
                            echo '<center class="alert">L\'idtype '.$_GET['idtype'].' est inexistant</center><br>';
                        }
                    } else {
                        echo '<center>'.mysqli_error($conn).'</center><br>';
                    }
                    
                    mysqli_close($conn);
                } else {    
                    
                    header('Location: 11list_type.php');
                    exit();
                }
            ?>
        </div>   
    </div>