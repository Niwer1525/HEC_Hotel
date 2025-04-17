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
	<title>Insérer Professeur</title>
	<!-- Fichier du LAB 7 -->
	<meta charset="UTF-8">
	<link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"> <!-- début contenant -->
		<?php include 'menu.php'; ?>
		<div> <!-- début contenu -->
			<h2 align ="center"> Nouveau Professeur</h2> 

			<!-- Formulaire pour ajouter un professeur-->
			<form name="insert_prof" action="insert_prof.php" method="post">
				<table align="center" border=0>
					<tr><td align=right>Matricule </td><td><input type="text" name="matricule"></td></tr>
					<tr><td align=right>Nom </td><td><input type="text" name="nom"></td></tr> 
					<tr><td align=right>Prénom </td><td><input type="text" name="prenom"></td></tr>
					<tr><td align=right>Email </td><td><input type="text" name="email"></td></tr>
					<tr><td align=right>GSM </td><td><input type="text" name="GSM"></td></tr>
					<tr><td align=right>UER </td><td><select name="UER">
						<option value="Langues">Langues</option>
						<option value="Economie">Economie</option>
						<option value="Finances et droit">Finances et droit</option>
						<option value="Operation">Operations</option>
						<option value="Management">Management</option>	
					</select></td></tr>
					<tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>
				</table>
			</form>

			<?php
			//Test si l'utilisateur a cliqué sur le bouton Inserer (au moins 1x)
			if (isset($_POST['sub_btn'])){ 
				// Récupérer les données du formulaire
				$matricule = $_POST['matricule'];
				$nom =  $_POST['nom'];
				$prenom = $_POST['prenom'];
				$email = $_POST['email'];
				$GSM = $_POST['GSM'];
				$UER = $_POST['UER'];		
				//Vérifier la qualité des données fournies
				if ($matricule =='' || $nom == '' || $prenom == '' || $email == ''){
					echo '<center class="alert">Matricule, nom, prénom et email ne peuvent pas être vides.</center><br>';
				}else{
					// Connexion à MySQL 
					require_once 'config.php';			
					// lancer la requête INSERT
					$sql = "INSERT INTO Professeur (matricule, nom, prenom, email, GSM, UER) VALUES ('$matricule', '$nom', '$prenom','$email','$GSM','$UER')";
					$result = mysqli_query($conn,$sql);	
					if ($result){
						echo '<center>Professeur rajouté dans la base de données</center><br>';
					} else {
						echo '<center>'.mysqli_error($conn).'</center><br>';
					}
					
					// déconnexion du serveur	
					mysqli_close($conn);
				}
			}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>