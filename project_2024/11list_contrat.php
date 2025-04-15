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
    <title>Liste - Contrats</title>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 

        <?php include '11menu.php'; ?>

        <div>               
           <form name="filtrer_contrats" action="" method="post">
                <table align="center" border=0>
                    <tr><td align=right>Choisir un client </td> 
                        <td><select name="idclient">
                            <option value="tout">tout</option>
                            <?php 
                                
                                require '11config.php';
                                
                                $sqlClient = "SELECT idclient, nom, prenom FROM client";

                                $resultClient = mysqli_query($conn, $sqlClient);
                                
                                while($row = mysqli_fetch_array($resultClient)){
                                    echo '<option value="'.$row['idclient'].'">'.$row['nom'].' '.$row['prenom'].' ('.$row['idclient'].')</option>';
                                }
                                
                                mysqli_close($conn);
                            ?>
                        </select></td>
                        <td align=right><input type="submit" name="filter_btn" value="Filtrer"> </td>
                        <td><input type="reset" name="res_btn" value="Réinitialiser"></td>
                    </tr> 
                </table>
            </form>
        </div>
        

    
        <div>
            <?php
                
                if(isset($_POST['filter_btn'])) {
                    $idclient = $_POST['idclient'];
                }else{
                    $idclient = "tout";
                }

                    require '11config.php';

                if ($idclient == "tout"){
                    $sql = "SELECT contrat.idcontrat, contrat.datecontrat, contrat.idclient as 'idclient' , client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie FROM contrat, typeassurance, client WHERE contrat.idtype = typeassurance.idtype AND contrat.idclient = client.idclient";

                } else {
                    
                    $sql = "SELECT contrat.idcontrat, contrat.datecontrat, contrat.idclient as 'idclient' , client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie FROM contrat, typeassurance, client WHERE contrat.idtype = typeassurance.idtype AND contrat.idclient = client.idclient AND client.idclient = $idclient";
                }
                $result = mysqli_query($conn,$sql); 
                    
                    echo '<table width="200" class="list">';
                    echo "<th>Idcontrat</th>
                    <th>Date contrat</th>
                    <th>Idclient</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Idtype</th>
                    <th>Nom type</th>
                    <th>Categorie</th>
                    <th></th>";
                    while($row = mysqli_fetch_array($result)) {
                        echo '<tr class="list">';
                        echo '<td class="list"><a href=11update_contrat.php?idcontrat='.$row['idcontrat'].'>'.$row['idcontrat'].'</a></td>';
                        echo '<td class="list">'.$row['datecontrat'].'</td>';
                        echo '<td class="list">'.$row['idclient'].'</td>';
                        echo '<td class="list">'.$row['nom'].'</td>';
                        echo '<td class="list">'.$row['prenom'].'</td>';
                        echo '<td class="list">'.$row['idtype'].'</td>';
                        echo '<td class="list">'.$row['nomtype'].'</td>';
                        echo '<td class="list">'.$row['categorie'].'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                mysqli_close($conn);
            
            ?>
        </div>

</div> 
</body>
</html>