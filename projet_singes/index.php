<?php
	//quand le client appluie sur le bouton administrateur
	if (isset($_POST['administrateur'])){		
		header("Location: ./administrateur/login.php");			
		exit();
	}elseif(isset($_POST['client'])) {  
	// quand le client appluie sur le bouton client
		header("Location: ./client/login.php");			
		exit();			
	}		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue à HEC Hotel</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./admin/style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->			
		<div class="menu"> <!-- début menu -->
			<ul class="menu"> <!-- Menu de gestion-->
				<li class="menu"><a class="active" href="index.php">Bienvenue dans l'application Hec Hotel</a></li>			
			</ul>
			<br><br> 		
		</div> <!-- fin menu -->
		<div> <!-- début contenu -->
			<h2 align ="center"> Poursuivre en tant que :</h2> 
			<form name="identification" action="index.php" method="post">
				<table align="center" border=0>
					<tr>
						<td align=center><a href="./administrateur/login.php"><img src="administrateur.png" width="300" alt="Administrateur"></a></td>
						<td align=center><a href="./client/login.php"><img src="client.png" width="300" alt="Client"></a></td>
					</tr>
					<tr>
						<td align=center><input type="submit" name="administrateur" value="Administrateur"></td>
						<td align=center><input type="submit" name="client" value="Professeur"></td>
					</tr>
				</table>
			</form>	
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>
