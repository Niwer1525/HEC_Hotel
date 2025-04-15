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
	<title>Liste - Cours</title>
	<!-- Fichier du Ex 1 -->
	<meta charset="UTF-8">
	<link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"> <!-- début contenant -->
		<?php include 'menu.php'; ?>
		<div><!-- début contenu -->
			<?php
				// Connexion à MySQL 
				require_once 'config.php';
				
				// Requete SELECT pour sélectionner tous les cours de la table Cours
				$sql = "SELECT code, intitule, credits, nbreHeures, quadrimestre, matricule FROM Cours";
				$result = mysqli_query($conn,$sql);	
				// Afficher les enregistrement de la table
				if (mysqli_num_rows($result) > 0) {
					// affiche les données de chaque enregistrement sous forme d'une table
					echo '<table class="list">';
					echo "<th>Code</th>
					<th>Intitulé</th>
					<th>Crédits</th>
					<th>NB Heures</th>
					<th>Quadrimestre</th>
					<th>Titulaire</th>
					<th></th>";
				  	while($row = mysqli_fetch_array($result)) {
						echo '<tr class="list">';
						echo '<td class="list"><a href=update_cours.php?code='.$row['code'].'>'.$row['code'].'</a></td>';
						echo '<td class="list">'.$row['intitule'].'</td>';
						echo '<td class="list">'.$row['credits'].'</td>';
						echo '<td class="list">'.$row['nbreHeures'].'</td>';
						echo '<td class="list">'.$row['quadrimestre'].'</td>';
						echo '<td class="list">'.$row['matricule'].'</td>';
						echo '<td class="list"><a href=delete_cours.php?code='.$row['code'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';
						echo '</tr>';
					}
					echo '</table>';
				} else {
					// affiche un message si pas de résultat
					echo "0 résultat";
				}
				// Fermer la connexion à la base de données
				mysqli_close($conn);
			?>
		</div><!-- fin contenu -->
	</div> <!-- fin contenant -->
</body>
</html>


