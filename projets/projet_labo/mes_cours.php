<?php
	// Etape 1 : initialiser la session
	session_start();
	// Etape 2 : vérifier si l'utilisateur s'est déjà authentifié. Le renvoyer au login sinon.
	if (!$_SESSION['matricule']){
		header('Location: login.php');
		exit();
	}		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mes cours</title>
	<!-- Fichier du LAB 12 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?> <!-- menu de navigation -->
		<div> <!-- début contenu -->
			<h2 align="center"> Mes cours</h2>
			<?php
				// Connexion à la base de données
				require_once 'config.php';
				// Etape 3 : Récupérer le matricule du prof connecté (via la session) 		
				$matricule = $_SESSION["matricule"];
				// Etape 4 : requête SELECT pour les cours du prof connecté
				$sql = "SELECT code, intitule, nbreHeures, credits, quadrimestre 
				FROM Cours WHERE matricule = '".$matricule."' ORDER BY quadrimestre ASC";					
				$result = mysqli_query($conn,$sql);
				// afficher les enregistrements de la table
				echo '<table class="list">';
				echo '<th>Code</th><th>Intitule</th><th>NB Heure</th><th>Credit</th><th>Quadrimestre</th>';
				while($row = mysqli_fetch_array($result)){
					echo '<tr class="list">';				
					echo '<td class="list" width="15%">'.$row['code'].'</td>';		
					echo '<td class="list" width="60%">'.$row['intitule'].'</td>';
					echo '<td class="list" width="15%">'.$row['nbreHeures'].'</td>';
					echo '<td class="list" width="10%">'.$row['credits'].'</td>';
					echo '<td class="list" width="10%">'.$row['quadrimestre'].'</td>';
					echo '</tr>';
				}
				echo '</table>';	
				// Etape 5 : Déconnexion du serveur
				mysqli_close($conn);
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>