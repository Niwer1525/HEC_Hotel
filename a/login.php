<?php	
	session_start();
	// Etape 1: si la session de l'utilisateur existe déjà, il n'oblige pas de s'authentifier et il renvoie directement à la page mes_cours
	if (isset($_SESSION['matricule'])){
		header("Location: mes_cours.php");
		exit();
	}
	// Traiter les informations quand le client appluie sur le bouton "Se connecter".
	if (isset($_POST['sub_btn'])){	
		// Connexion au serveur MySQL	
		require_once 'config.php'; 
		// Etape 2 : Récupérer les données
		$matricule = $_POST['matricule'];
		$password = $_POST['password'];
		// Etape 3: Interroger la base de données avec matricule et password donnés
		$sql = "SELECT * FROM Professeur WHERE matricule='".$matricule."' AND motdepasse ='".$password."'";
		$result = mysqli_query($conn,$sql);
		$nbLigne = mysqli_num_rows($result); 
		// Fermer la connexion 
		mysqli_close($conn);
		// Etape 4 : Vérifier que matricule et password sont corrects (c'est-à-dire $nbLigne >0 )
		if ($nbLigne >0){
			// Etape 5 : Sauvegarder le nom de l'utilisateur, puis rediriger vers la page mes_cours.php
			$_SESSION['matricule']=$matricule;
			header("Location: mes_cours.php");			
			exit();
		}else{  
			// dans le cas contraire, afficher un message d'erreur et rester sur la même page
			$message = '<center class="alert">Mauvais matricule ou mot de passe</center><br>';
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Client</title>
	<!-- Fichier du LAB 11 --> 
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<div class="menu"> <!-- début menu -->
			<ul class="menu"> <!-- Menu de gestion-->
				<li class="menu"><a class="active" href="login.php">Se connecter</a></li>
				<li class="menu"><a href="signup.php">Créer un compte</a></li>			
			</ul> 		
		</div> <!-- fin menu -->	
		<div> <!-- début contenu -->
			<h2 align ="center"> Se connecter</h2> 
			<?php 	
				//Le message est affiché quand client ou son mot de passe ne sont pas corrects.
				if (isset($message)){
					echo $message;
					unset($message);
				}
			?>	
			<form name="seconnecter" action="login.php" method="post">
				<table align="center" border=0>
					<tr>
						<td align=right>Matricule </td>
						<td><input type="text" name="matricule" required></td></tr>
					<tr>
						<td align=right>Mot de passe </td>
						<td><input type="password" name="password"></td></tr>
					<tr>
						<td></td>
						<td align=right><input type="submit" name="sub_btn" value="Se connecter"></td>
					</tr>
				</table>
			</form>	
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>