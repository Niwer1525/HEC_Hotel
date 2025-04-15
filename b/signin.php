<?php
	// Traiter les informations quand le client appluie sur le bouton "Se connecter".
	if (isset($_POST['sub_btn'])){
		// Etape 1 : Récupérer les données.
		$username = $_POST['username'];
		$password = $_POST['password'];	
		// Etape 2: Vérifier que username et password sont corrects		
		if(($username == "admin") AND ($password == "admin")){
			$message = "<center>Bienvenue $username</center><br>";
		}else{  // dans le cas contraire, afficher un message d'erreur
			$message = '<center class="alert">Mauvais nom d\'utilisateur ou mot de passe</center><br>';			
		}		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Administrateur</title>
	<!-- Fichier du LAB 9 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<div class="menu"> <!-- début menu -->
			<ul class="menu"> <!-- Menu de gestion-->
				<li class="menu"><a class="active" href="login.php">Se connecter</a></li>			
			</ul>
			<br><br> 		
		</div> <!-- fin menu -->	
		<div> <!-- début contenu -->
			<h2 align ="center"> Se connecter</h2> 
			<?php 
				//il est affiché quand le client ou son mot de passe ne sont pas corrects.
				if (isset($message)){
					echo $message;
					unset($message);
				}
			?>
			<form name="login" action="signin.php" method="post">
				<table align="center" border=0>
					<tr>
						<td align=right>Nom d'utilisateur </td>
						<td><input type="text" name="username" required></td>
					</tr>
					<tr>
						<td align=right>Mot de passe </td>
						<td><input type="password" name="password" required></td>
					</tr>
					<tr>
						<td></td>
						<td align=right><input type="submit" name="sub_btn" value="Se connecter"></td></tr>
				</table>
			</form>	
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>