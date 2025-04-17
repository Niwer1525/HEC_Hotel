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
    <title>Modifier Type d'assurance</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant">   
        <?php include '11menu.php'; ?>
        <div> 
            <h2 align="center"> Modifier le Type d'assurance</h2>

            <?php 

            if (isset($_GET['idtype'])){

                require_once '11config.php';

                $idtype = $_GET['idtype'];
                $sql = "SELECT * FROM typeassurance WHERE idtype = '".$idtype."'";
                $result = mysqli_query($conn,$sql);
                $nbLignes = mysqli_num_rows($result);

                if ($nbLignes == 0){
                    die("<center class=\"alert\">L\'idtype '$idtype' n'existe pas.</center>");
                }else{
                    $row = mysqli_fetch_array($result);
                    $nomtype = $row['nomtype'];
                    $categorie = $row['categorie'];
                }

                if (isset($_POST['save_btn'])){
                    $nomtype = $_POST['nomtype'];
                    $categorie = $_POST['categorie'];

                    $sqlUpDate = "UPDATE typeassurance SET nomtype='".$nomtype."', categorie='".$categorie."' WHERE idtype = '".$idtype."'";
                    if (!mysqli_query($conn, $sqlUpDate)){
                        die('Erreur:'.mysqli_error($conn)); 
                   }else{
                  echo "<center>Le type d'assurance $idtype a bien été modifié dans la base de données.</center>";
                    
                }
            }

            echo '<form name="update_type" action="11update_type.php?idtype='.$idtype.'" method="post">';
            echo '<table align="center">';
            echo '<tr><td align=right>Idtype: </td><td>'.$idtype.'<input type="hidden" name ="code" value="'.$idtype.'"></td></tr>';
            echo '<tr><td align=right>Type d\'assurance: </td><td><input type="text" name="nomtype" value="'.$nomtype.'" required></td></tr>';
            echo '<tr><td align=right>Catégorie: </td><td><select name="categorie" value="'.$categorie.'">';

                $list_categorie = array("habitiation","auto","rc","assistance");
                for ($i=0;$i<sizeof($list_categorie);$i++){

                    if ($list_categorie[$i] == $categorie){
                        echo '<option value="'.$list_categorie[$i].'" selected>'.$list_categorie[$i].'</option>';

                     }else{
                        echo '<option value="'.$list_categorie[$i].'">'.$list_categorie[$i].'</option>';
                     }

                }
                        echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
                        echo '</table>';
                        echo '</form>'; 
                }else{  
                    
                    header('Location: 11list_type.php');
                    exit();
                }
            ?>
    </div>
</div>
</body>
</html>
