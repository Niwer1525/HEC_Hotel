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
	<title>Recherche - Cours</title>
	<!-- Fichier du Ex 5 -->
	<meta charset="UTF-8">
	<link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"> <!-- début contenant -->
		<?php include 'menu.php'; ?>
		<div><!-- début contenu -->
			<h2 align="center">Rechercher Cours</h2>

			<!-- Formulaire de recherche -->
			<form name="search_cours" action="search_cours.php" method="post">
				<table align="center" border=0>
					<tr>
						<td align="right">Nom du cours recherché</td>
						<td><input type="text" name="keyword"></td>
					</tr>
					<tr>
						<td align="right"><input type="submit" name="sub_btn" value="Rechercher"></td>
						<td><input type="reset" name="res_btn" value="Réinitialiser"></td>
					</tr>
				</table>
			</form>

			<!-- Traitons les données reçues du formulaire -->
			<?php
				if (isset($_POST['sub_btn'])){
					// Connexion à MySQL 
					require_once 'config.php';
					$keyword = $_POST['keyword'];
					// Requete SELECT pour sélectionner tous les cours de la table Cours
					$sql = "SELECT Cours.code, Cours.intitule, Cours.credits, Cours.nbreHeures, Cours.quadrimestre, Cours.matricule, Professeur.nom, Professeur.prenom FROM Cours LEFT JOIN Professeur ON Cours.matricule=Professeur.matricule WHERE Cours.code LIKE '%".$keyword."%' OR Cours.intitule LIKE '%".$keyword."%'";
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
						<th>Nom</th>
						<th>Prénom</th>";
					  	while($row = mysqli_fetch_array($result)) {
							echo '<tr class="list">';
							echo '<td class="list">'.$row['code'].'</a></td>';
							echo '<td class="list">'.$row['intitule'].'</td>';
							echo '<td class="list">'.$row['credits'].'</td>';
							echo '<td class="list">'.$row['nbreHeures'].'</td>';
							echo '<td class="list">'.$row['quadrimestre'].'</td>';
							echo '<td class="list">'.$row['matricule'].'</td>';
							echo '<td class="list">'.$row['nom'].'</td>';
							echo '<td class="list">'.$row['prenom'].'</td>';
							echo '</tr>';
						}
						echo '</table>';
					} else {
						// affiche un message si pas de résultat
						echo "0 résultat à afficher";
					}
					// Fermer la connexion à la base de données
					mysqli_close($conn);
				}
			?>
		</div><!-- fin contenu -->
	</div> <!-- fin contenant -->
</body>
</html>


