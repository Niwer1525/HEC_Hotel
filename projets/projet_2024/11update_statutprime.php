<?php 
    session_start();
    if (!isset($_SESSION['username'])){
    	header("Location: 11login.php");
    	exit();
    }
?>
<head>
    <title>Payer la prime</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">   
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align="center"> Confirmation du changement de statut de la prime </h2>

            <?php 

                if (isset($_GET['idprime'])){

                    require_once '11config.php';

                    $idprime = $_GET['idprime'];
                    $sql = "SELECT * FROM prime WHERE idprime = '".$idprime."'";
                    $result = mysqli_query($conn,$sql);
                    $nbLignes = mysqli_num_rows($result);

                    if ($nbLignes == 0){
                        die("<center class=\"alert\">La prime n'existe pas.</center>");
                        }else{
                        $row = mysqli_fetch_array($result);
                        $statutprime = $row['statutprime'];
                        }

                    if (isset($_POST['save_btn'])){
                  
                    $idprime = $_POST['idprime'];
                   
                    $sqlUpDate = "UPDATE prime SET statutprime='payee' WHERE idprime = '".$idprime."'";
                        if (!mysqli_query($conn, $sqlUpDate)){
                        die('Erreur:'.mysqli_error($conn)); 
                        }else{
                        echo "<center>La prime $idprime a bien été payée.</center>";
                    
                    }
                }

                    echo '<form name="update_type" action="11update_statutprime.php?idprime='.$idprime.'" method="post">';
                    echo '<table align="center">';
                    echo '<tr><td align=right>Idprime: </td><td>'.$idprime.'<input type="hidden" name ="idprime" value="'.$idprime.'"></td></tr>';
                    echo '<tr><td align=right><input type="submit" name="save_btn" value="payer"></td></tr>';
                    echo '</table>';
                    echo '</form>'; 

                }else{  
                    
                    header('Location: 11list_prime.php');
                    exit();
                }
            ?>
        </div>
    </div>
</body>
</html>
