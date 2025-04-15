<?php
	// Initialiser la session
	session_start();
	// Etape 1 : Vérifier si l'utilisateur s'est déjà authentifié. Le renvoyer à ses cours si oui.
	if (isset($_SESSION['matricule'])){
		header("Location: mes_cours.php");		
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un compte</title>
	<!-- Fichier du LAB 14 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<div class="menu"> <!-- début menu -->
			<ul class="menu"> <!-- Menu de gestion-->
				<li class="menu"><a href="login.php">Se connecter</a></li>
				<li class="menu"><a class="active" href="signup.php">Créer un compte</a></li>			
			</ul> 		
		</div> <!-- fin menu -->	
		<div> <!-- début contenu -->
			<h2 align ="center"> Créer un compte</h2> 

			<!-- Formulaire pour ajouter un professeur-->
			<form name="signup" action="signup.php"  method="post">
				<table align="center" border=0>
					<tr><td align=right>Matricule </td><td><input type="text" name="matricule" required></td></tr>
					<tr><td align=right>Nom </td><td><input type="text" name="nom" required></td></tr> 
					<tr><td align=right>Prénom </td><td><input type="text" name="prenom" required></td></tr>
					<tr><td align=right>Email </td><td><input type="text" name="email" required></td></tr>
					<tr><td align=right>GSM </td><td><input type="text" name="GSM"></td></tr>
					<tr><td align=right>UER </td><td><select name="UER">
						<option value="Langues">Langues</option>
						<option value="Economie">Economie</option>
						<option value="Finances et droit">Finances et droit</option>
						<option value="Operation">Operations</option>
						<option value="Management">Management</option>
					</select></td></tr>
					<tr><td align=right>Mot de passe </td><td><input type="password" name="motdepasse" required></td></tr>
					<tr><td align=right><input type="submit" name="sub_btn" value="Créer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>
				</table>
			</form>

			<?php
				// Etape 2 : Test si l'utilisateur a cliqué sur le bouton Créer (au moins 1x)
				if (isset($_POST['sub_btn'])){ 
					// Récupérer les données de la formulaire
					$matricule = $_POST["matricule"];
					$nom= $_POST["nom"];
					$prenom= $_POST["prenom"];
					$email= $_POST["email"];
					$GSM = $_POST["GSM"];
					$UER = $_POST["UER"];
					$motdepasse=$_POST["motdepasse"];
					
					// pas besoin de vérifier que les données ne sont pas vides, grâce à l'attribut required dans le formulaire
					//Connexion à MySQL
					require_once 'config.php';
					// Etape 3: lancer la requête INSERT INTO
					$sql = "INSERT INTO Professeur ( matricule, nom, prenom, email, GSM, UER, motdepasse) 
					VALUES ('$matricule','$nom', '$prenom','$email', '$GSM','$UER','$motdepasse')";
					$result = mysqli_query($conn,$sql);	
					if ($result){
						echo "<center>Professeur $nom a bien été ajouté dans la base de données</center> <br>"; 		
					}else{
						echo '<center>'.mysqli_error($conn).'</center> <br>';
					}
					//déconnexion du serveur
					mysqli_close($conn);
				}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>