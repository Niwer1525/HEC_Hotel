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
            <h2 align ="center">Suppression de la prime</h2>
            <?php
                
                if (isset($_GET['idprime'])){
                     
                    require_once '11config.php';
                   
                    $sql = "DELETE FROM prime where idprime='".$_GET['idprime']."'";
                    $result = mysqli_query($conn,$sql); 
                    if ($result){
                        if(mysqli_affected_rows($conn)>0) {
                            echo '<center>prime '.$_GET['idprime'].' supprimée de la base de données</center><br>';
                        }else{
                            echo '<center class="alert">L\'idprime '.$_GET['idprime'].' est inexistant</center><br>';
                        }
                    } else {
                        echo '<center>'.mysqli_error($conn).'</center><br>';
                    }
                    
                    mysqli_close($conn);
                } else {    
                    
                    header('Location: 11list_prime.php');
                    exit();
                }
            ?>
        </div>   
    </div>