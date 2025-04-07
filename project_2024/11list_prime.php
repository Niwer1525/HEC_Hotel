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
    <title>Liste - Primes</title>
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


                    <td align=right>Choisir un type d'assurance </td> 
                        <td><select name="idtype">
                            <option value="all">tout</option>
                            <?php 
                                
                                require '11config.php';
                                
                                $sqlTypeassurance = "SELECT idtype, nomtype, categorie FROM typeassurance";

                                $resultTypeassurance = mysqli_query($conn, $sqlTypeassurance);
                                
                                while($row = mysqli_fetch_array($resultTypeassurance)){
                                    echo '<option value="'.$row['idtype'].'">'.$row['nomtype'].' '.$row['categorie'].' ('.$row['idtype'].')</option>';
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
                    $idtype = $_POST['idtype'];
                }else{
                    $idclient = "tout";
                     $idtype = "all";
                }

                    require '11config.php';

                    if ($idclient == "tout" AND $idtype == "all"){
                        $sql = "SELECT prime.idprime, prime.dateprime, prime.montant, prime.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie, prime.statutprime 
                        FROM prime, contrat, client, typeassurance 
                        WHERE prime.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND contrat.idtype = typeassurance.idtype ";

                } elseif ($idclient == "tout" AND $idtype != "all") {
                    $sql = "SELECT prime.idprime, prime.dateprime, prime.montant, prime.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie, prime.statutprime 
                        FROM prime, contrat, client, typeassurance 
                        WHERE prime.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND contrat.idtype = typeassurance.idtype AND typeassurance.idtype = $idtype";
                    
                } elseif ($idclient != "tout" AND $idtype == "all") {
                    $sql ="SELECT prime.idprime, prime.dateprime, prime.montant, prime.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie, prime.statutprime 
                        FROM prime, contrat, client, typeassurance 
                        WHERE prime.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND client.idclient = $idclient AND contrat.idtype = typeassurance.idtype";
                    
                } else {
                    
                    $sql = "SELECT prime.idprime, prime.dateprime, prime.montant, prime.idcontrat as 'idcontrat', contrat.idclient as 'idclient', client.nom, client.prenom, contrat.idtype as 'idtype', typeassurance.nomtype, typeassurance.categorie, prime.statutprime 
                        FROM prime, contrat, client, typeassurance 
                        WHERE prime.idcontrat = contrat.idcontrat AND contrat.idclient = client.idclient AND client.idclient = $idclient AND contrat.idtype = typeassurance.idtype AND typeassurance.idtype = $idtype";
                }
                $result = mysqli_query($conn,$sql); 
                    
                    echo '<table width="200" class="list">';
                    echo "<th>Idprime</th>
                    <th>Date prime</th>
                    <th>Montant</th>
                    <th>Idcontrat</th>
                    <th>Idclient</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Idtype</th>
                    <th>Nom type</th>
                    <th>Categorie</th>
                    <th>Statut prime</th>
                    <th>Paiement</th>";

                    while($row = mysqli_fetch_array($result)) {
                        echo '<tr class="list">';
                        echo '<td class="list">'.$row['idprime'].'</td>';
                        echo '<td class="list">'.$row['dateprime'].'</td>';
                        echo '<td class="list">'.$row['montant'].'</td>';
                        echo '<td class="list">'.$row['idcontrat'].'</td>';
                        echo '<td class="list">'.$row['idclient'].'</td>';
                        echo '<td class="list">'.$row['nom'].'</td>';
                        echo '<td class="list">'.$row['prenom'].'</td>';
                        echo '<td class="list">'.$row['idtype'].'</td>';
                        echo '<td class="list">'.$row['nomtype'].'</td>';
                        echo '<td class="list">'.$row['categorie'].'</td>';
                        echo '<td class="list">'.$row['statutprime'].'</td>';

                        if($row['statutprime']=="a payer"){

                        echo '<td class="list"><a href=11update_statutprime.php?idprime='.$row['idprime'].'> Payer </a></td>';

                        } else {
                            
                            echo '<td class="list" title="Impossible de payer une prime déjà payée."> </td>';
                        }

                        $sqlIdprime = "SELECT * FROM prime WHERE idprime ='".$row['idprime']."'";
                        $resultIdprime = mysqli_query($conn,$sqlIdprime);
                    
                        echo '<td class="list"><a href=11delete_prime.php?idprime='.$row['idprime'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';

                        echo '</tr>';
                }
                    echo '</table>';
                mysqli_close($conn);
            
            ?>
        </div>
    </div>
</body>
</html>
