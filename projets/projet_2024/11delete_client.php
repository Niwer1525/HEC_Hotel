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
    <title>Supprimer Client</title>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">    
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align ="center">Suppression du Client</h2>
            <?php
                
                if (isset($_GET['idclient'])){
                     
                    require_once '11config.php';
                   
                    $sql = "DELETE FROM client where idclient='".$_GET['idclient']."'";
                    $result = mysqli_query($conn,$sql); 
                    if ($result){
                        if(mysqli_affected_rows($conn)>0) {
                            echo '<center>Client '.$_GET['idclient'].' supprimé de la base de données</center><br>';
                        }else{
                            echo '<center class="alert">L\'idclient '.$_GET['idclient'].' est inexistant</center><br>';
                        }
                    } else {
                        echo '<center>'.mysqli_error($conn).'</center><br>';
                    }
                    
                    mysqli_close($conn);
                } else {    
                    
                    header('Location: 11list_client.php');
                    exit();
                }
            ?>
        </div>   
    </div>