<?php
	session_start();
	//si le nom de l'utilisateur n'est pas défini, il demande de s'authentifier sur login.php
	if (!(isset($_SESSION['username']))){
		header("Location: login.php");		
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier Professeur</title>
	<!-- Fichier du LAB 7 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div> <!-- début contenu -->
			<h2 align="center"> Modifier Professeur</h2>

			<?php
				// Tester si l'input avec la methode GET existe (matricule), s'il existe on peut demander la mise à jour, sinon on redirige vers list_prof.php
				if (isset($_GET['matricule'])){
					// Connexion à MySQL 
					require_once 'config.php';
					//Etape 1: Récupérer les informations de ce matricule (faire un SELECT)	
					$matricule = $_GET['matricule'];
					$sql = "SELECT * FROM Professeur WHERE matricule = '" . $matricule . "'";
					$result = mysqli_query($conn,$sql);
					$nbLignes = mysqli_num_rows($result);

					if ($nbLignes == 0){
						die("<center class=\"alert\">Le matricule '$matricule' n'existe pas.</center>");
					} else {
						$row = mysqli_fetch_array($result);
						$nom = $row['nom'];
						$prenom = $row['prenom'];
						$email = $row['email'];
						$GSM = $row['GSM'];
						$UER = $row['UER'];
						$list_UER=array("Langues","Economie","Finances et droit","Management","Operations");
					}
					
					//Etape 2: Traiter l'info si l'utilisateur clique sur le bouton Modifier
					if (isset($_POST['save_btn'])){
						$nom = $_POST['nom'];
						$prenom = $_POST['prenom'];
						$email = $_POST['email'];
						$GSM = $_POST['GSM'];
						$UER = $_POST['UER'];
						// Vérifier la qualité des données (comme dans insert_prof.php)
						if ($matricule =='' || $nom == '' || $prenom == '' || $email == ''){
							echo '<center class="alert">Matricule, nom, prénom et email ne peuvent pas être vides.</center><br>';
						}else{
							$sqlUpDate = "UPDATE Professeur SET nom='".$nom."', prenom='".$prenom."', email='".$email."', GSM='".$GSM."', UER='".$UER."' WHERE matricule='".$matricule."'";
							if (!mysqli_query($conn, $sqlUpDate)) {
								die('Erreur:'.mysqli_error($conn));
							}else{
								echo "<center>Professeur $matricule a été modifié dans la base de données.</center>";
							}
						}
					}
					
					//Afficher l'information du professeur avec ce matricule dans le formulaire
					echo '<form name="prof_update" action="update_prof.php?matricule='.$matricule.'" method="post">';
					echo '<table align="center">';
					echo '<tr><td align=right>Matricule: </td><td>'.$matricule.'<input type="hidden" name="matricule" value="'.$matricule.'"></td></tr>'; 
					echo '<tr><td align=right>Nom: </td><td><input type="text" name="nom" value="'.$nom.'"></td></tr>'; 
					echo '<tr><td align=right>Prénom: </td><td><input type="text" name="prenom" value="'.$prenom.'"></td></tr>';
					echo '<tr><td align=right>Email: </td><td><input type="text" name="email" value="'.$email.'"></td></tr>';
					echo '<tr><td align=right>GSM: </td><td><input type="text" name="GSM" value="'.$GSM.'"></td></tr>';
					echo '<tr><td align=right>UER: </td><td><select name="UER" value="'.$UER.'">';
						
						//afficher les options pour UER
						for ($i=0;$i<sizeof($list_UER);$i++){
							if ($list_UER[$i] == $UER){  // si c'est UER du professeur --> selected
								echo '<option value="'.$list_UER[$i].'" selected>'.$list_UER[$i].'</option>';
							}else{
								echo '<option value="'.$list_UER[$i].'">'.$list_UER[$i].'</option>';
							}
						}		
					echo '</select>';
					echo '</td></tr>';			
					echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
					echo '</table>';
					echo '</form>';						
					
					echo '<br>';
					echo '<br>';
					
					// Lister les cours de ce professeur
					$result_cours = mysqli_query($conn, "SELECT * FROM Cours WHERE matricule = '" . $matricule . "'");
					echo '<table class="list" align="center">';
					echo '<th>Code</th><th>Intitulé</th><th>Crédits</th><th>NbHeures</th><th>Quadrimestre</th>';
					while($row_cours = mysqli_fetch_array($result_cours)){
						echo '<tr class="list">';
						echo '<td class="list" width="10%">'.$row_cours['code'].'</a> </td>';
						echo '<td class="list" width="40%">'.$row_cours['intitule'].'</td>';
						echo '<td class="list" width="10%">'.$row_cours['credits'].'</td>';
						echo '<td class="list" width="10%">'.$row_cours['nbreHeures'].'</td>';
						echo '<td class="list" width="10%">'.$row_cours['quadrimestre'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
					// Déconnexion du serveur
					mysqli_close($conn);
				
				}else{  
					// Si l'input du matricule n'existe pas, on redirige vers la liste des professeurs
					header('Location: list_prof.php');
					exit();
				}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>