<?php
	// Initialiser la session
	session_start();
	// Vérifier si l'utilisateur s'est déjà authentifié. Le renvoyer au login sinon.
	if (!(isset($_SESSION['matricule']))){
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Mes données</title>
	<!-- Fichier du LAB 13 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?> <!-- menu de navigation -->
		<div> <!-- début contenu -->
			<h2 align="center"> Modifier mes informations</h2>
			<?php
				// Connexion à la base de données
				require_once 'config.php';
				// Etape 1 : Récupérer le matricule du prof connecté (via la session) 		
				$matricule = $_SESSION["matricule"];		
				// Etape 2 : requête SELECT pour les données du prof connecté
				$sql = "SELECT * FROM Professeur WHERE matricule = '" . $matricule . "'";
				$result = mysqli_query($conn, $sql); 
				// Comme le prof est connecté, on est sur que le résultat contient exactement 1 ligne
				// Etape 3 : récupérer les informations de cette ligne
				$row = mysqli_fetch_array($result);
				$nom=$row['nom'];
				$prenom=$row['prenom'];
				$email=$row['email'];
				$GSM=$row['GSM'];
				$UER=$row['UER'];
				$motdepasse = $row['motdepasse'];
				$list_UER = array("Langues","Economie","Finances et droit","Operations","Management");		
		
				// Traiter l'info si l'utilisateur clique sur le bouton Modifier
				if (isset($_POST["save_btn"])){
					$nom=$_POST["nom"];
					$prenom=$_POST["prenom"];
					$email=$_POST["email"];
					$GSM=$_POST["GSM"];
					$UER=$_POST["UER"];
					$motdepasse = $_POST["motdepasse"];
					// Vérifier la qualité des données (comme dans insert_prof.php)
					if($_POST["nom"] == ''|| $_POST["prenom"] == ''|| $_POST["email"] == ''){
						echo '<center class="alert">Nom, prénom ou email ne peuvent pas être vides.</center>';
					}else{
						// Etape 4 : Requête pour la mise à jour
						$sqlUpDate = "UPDATE Professeur SET nom='".$nom."', prenom='".$prenom."', email='".$email."', GSM='".$GSM."', UER='".$UER."',motdepasse='".$motdepasse."' WHERE matricule='".$matricule."'";
						if (!mysqli_query($conn,$sqlUpDate)){
							die('Erreur: ' . mysqli_error($conn)); 
						}
						echo "<center>Professeur ".$matricule." modifié dans la base de données</center>";
					}			
				}
		
				// Afficher l'information du professeur avec ce matricule dans le formulaire
				echo '<form name="mon_compte" action="mon_compte.php" method="post">';
				echo '<table align="center">';
				// Etape 5 : Input de type hidden pour que le matricule fasse partie des données envoyées par le formulaire
				echo '<tr><td align=right>Matricule: </td><td>'.$matricule.'<input type="hidden" name="matricule" value="'.$matricule.'"></td></tr>'; 
				echo '<tr><td align=right>Nom: </td><td><input type="text" name="nom" value="'.$nom.'"></td></tr>'; 
				echo '<tr><td align=right>Prénom: </td><td><input type="text" name="prenom" value="'.$prenom.'"></td></tr>';
				echo '<tr><td align=right>Email: </td><td><input type="text" name="email" value="'.$email.'"></td></tr>';
				echo '<tr><td align=right>GSM: </td><td><input type="text" name="GSM" value="'.$GSM.'"></td></tr>';
				echo '<tr><td align=right>UER: </td><td><select name="UER" value="'.$UER.'"">';
			
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
				echo '<tr><td align=right>Mot de passe: </td><td><input type="password" name="motdepasse" value="'.$motdepasse.'" required></td></tr>';			
				echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';		
				echo '</table>';
				echo '</form>';						
				
				// Déconnexion du serveur
				mysqli_close($conn);	
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>