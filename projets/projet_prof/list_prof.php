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
	<title>Liste - Professeur</title>
	<!-- Fichier du LAB 7 -->
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
				
				// Requete SELECT pour sélectionner tous les profs de la table Professeur
				$sql = "SELECT matricule, nom, prenom, email, GSM, UER FROM Professeur";
				$result = mysqli_query($conn,$sql);	
				// Afficher les enregistrement de la table
				if (mysqli_num_rows($result) > 0) {
					// affiche les données de chaque enregistrement sous forme d'une table
					echo '<table class="list">';
					echo "<th>Matricule</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>GSM</th>
					<th>UER</th>
					<th></th>";
				  	while($row = mysqli_fetch_array($result)) {
						echo '<tr class="list">';
						echo '<td class="list"><a href=update_prof.php?matricule='.$row['matricule'].'>'.$row['matricule'].'</a></td>';
						echo '<td class="list">'.$row['nom'].'</td>';
						echo '<td class="list">'.$row['prenom'].'</td>';
						echo '<td class="list">'.$row['email'].'</td>';
						echo '<td class="list">'.$row['GSM'].'</td>';
						echo '<td class="list">'.$row['UER'].'</td>';
						// La possibilité de supprimer n'est disponible que lorsque le prof n'est pas assigné à un cours
						// Vérifions si le prof apparaît dans la liste des cours
						$sqlMatricule = "SELECT * FROM Cours WHERE matricule ='".$row['matricule']."'";
						$resultMatricule = mysqli_query($conn,$sqlMatricule);
						if(mysqli_num_rows($resultMatricule)==0){
							// Si le résultat contient 0 cours, on peut supprimer. Donc on affiche la poubelle.
							echo '<td class="list"><a href=delete_prof.php?matricule='.$row['matricule'].'> <img src="trash.png" alt="Delete" height="30"></a></td>';
						} else {
							// Si le résultat contient 1 ou des cours, on n'affiche rien.
							echo '<td class="list" title="Impossible de supprimer un prof donnant un cours."> </td>';
						}
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


