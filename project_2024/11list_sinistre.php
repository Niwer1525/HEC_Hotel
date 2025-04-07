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
    <title>Liste - Sinistres</title>
    <meta charset="UTF-8">
    <link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="contenant"> 

        <?php include '11menu.php'; ?>

        <div>               
           <form name="filtrer" action="" method="post">
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
                    $sql = "SELECT sinistre.idsinistre, sinistre.datesinistre, sinistre.statutsinistre, sinistre.montantrembourse, sinistre.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie 
                        FROM sinistre, contrat, client, typeassurance 
                        WHERE sinistre.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND contrat.idtype = typeassurance.idtype";

                } else {
                    
                    $sql = "SELECT sinistre.idsinistre, sinistre.datesinistre, sinistre.statutsinistre, sinistre.montantrembourse, sinistre.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie 
                        FROM sinistre, contrat, client, typeassurance 
                        WHERE sinistre.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND client.idclient = $idclient AND contrat.idtype = typeassurance.idtype";
                }
                $result = mysqli_query($conn,$sql); 
                    
                    echo '<table width="200" class="list">';
                    echo "<th>Idsinistre</th>
                    <th>Date sinistre</th>
                    <th>Statut sinistre</th>
                    <th>montant remboursé</th>
                    <th>Idcontrat</th>
                    <th>Idclient</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Idtype</th>
                    <th>Nom type</th>
                    <th>Categorie</th>
                    <th></th>";
                    while($row = mysqli_fetch_array($result)) {
                        echo '<tr class="list">';
                        echo '<td class="list"><a href=11update_sinistre.php?idsinistre='.$row['idsinistre'].'>'.$row['idsinistre'].'</a></td>';
                        echo '<td class="list">'.$row['datesinistre'].'</td>';
                        echo '<td class="list">'.$row['statutsinistre'].'</td>';
                        echo '<td class="list">'.$row['montantrembourse'].'</td>';
                        echo '<td class="list">'.$row['idcontrat'].'</td>';
                        echo '<td class="list">'.$row['idclient'].'</td>';
                        echo '<td class="list">'.$row['nom'].'</td>';
                        echo '<td class="list">'.$row['prenom'].'</td>';
                        echo '<td class="list">'.$row['idtype'].'</td>';
                        echo '<td class="list">'.$row['nomtype'].'</td>';
                        echo '<td class="list">'.$row['categorie'].'</td>';


                        $sqlIdsinistre = "SELECT * FROM sinistre WHERE idsinistre ='".$row['idsinistre']."'";
                        $resultIdsinistre = mysqli_query($conn,$sqlIdsinistre);
                        echo '<td class="list"><a href=11delete_sinistre.php?idsinistre='.$row['idsinistre'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
        
                mysqli_close($conn);
            
            ?>
        </div>

</div> 
</body>
</html>