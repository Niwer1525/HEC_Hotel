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
	<title>Insérer Cours</title>
	<!-- Fichier de l'ex 2 -->
	<meta charset="UTF-8">
	<link rel ="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"> <!-- début contenant -->
		<?php include 'menu.php'; ?>
		<div> <!-- début contenu -->
			<h2 align ="center">Nouveau Cours</h2> 

			<!-- Formulaire pour ajouter un cours-->
			<form name="insert_cours" action="insert_cours.php" method="post">
				<table align="center" border=0>
					<tr><td align=right>Code </td><td><input type="text" name="code" required></td></tr>
					<tr><td align=right>Intitulé </td><td><input type="text" name="intitule" required></td></tr> 
					<tr><td align=right>Crédits </td><td><input type="text" name="credits" required></td></tr>
					<tr><td align=right>Nombre d'heures </td><td><input type="text" name="nbreHeures" required></td></tr>
					<tr><td align=right>Quadrimestre </td>	<!-- Liste déroulante pour le quadrimestre -->
						<td><select name="quadrimestre"> 
							<option value="Q1">Q1</option>
							<option value="Q2">Q2</option>
							<option value="TA">TA</option>
						</select></td>
					</tr>
					<tr><td align=right>Titulaire </td>	<!-- Liste déroulante pour le titulaire /!\ Cette liste est dynamique, elle dépend de la DB -->
						<td><select name="matricule">
							<option value="NULL"></option> <!-- Il faut permettre de ne pas assigner le cours à un titulaire -->
							<?php 
								// Configuration pour connecter à la base de donnée
								require 'config.php';
								// Requête SELECT pour avoir la liste des professeurs (nom, prénom et matricule par ordre alphabétique)
								$sqlProf = "SELECT DISTINCT nom, prenom, matricule FROM Professeur ORDER BY nom, prenom";
								$resultProf = mysqli_query($conn, $sqlProf);
								// Afficher le menu déroulant avec les profs
								while($row = mysqli_fetch_array($resultProf)){
									echo '<option value="'.$row['matricule'].'">'.$row['nom'].' '.$row['prenom'].' ('.$row['matricule'].')</option>';
								}
								// Fermeture de la connexion
								mysqli_close($conn);
							?>
						</select></td>
					</tr>
					<tr><td align=right><input type="submit" name="sub_btn" value="Inserer"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>
				</table>
			</form>

			<?php
			//Test si l'utilisateur a cliqué sur le bouton Inserer (au moins 1x)
			if (isset($_POST['sub_btn'])){ 
				// Récupérer les données du formulaire
				$code = $_POST['code'];
				$intitule =  $_POST['intitule'];
				$credits = $_POST['credits'];
				$nbreHeures = $_POST['nbreHeures'];
				$quadrimestre = $_POST['quadrimestre'];
				$matricule = $_POST['matricule'];		
				// Inutile de vérifier la qualité des données fournies vue l'attribut required dans le formulaire
				// Connexion à MySQL
				require 'config.php';			
				// Lancer la requête INSERT
				if ($matricule == "NULL"){ // Il ne faut pas de guillemets autour de NULL
					$sql = "INSERT INTO Cours (code, intitule, credits, nbreHeures, quadrimestre, matricule) VALUES ('$code', '$intitule', '$credits','$nbreHeures','$quadrimestre', NULL)";
				} else { 
					$sql = "INSERT INTO Cours (code, intitule, credits, nbreHeures, quadrimestre, matricule) VALUES ('$code', '$intitule', '$credits','$nbreHeures','$quadrimestre', '$matricule')";
				}

				
				$result = mysqli_query($conn,$sql);	
				if ($result){
					echo '<center>Cours rajouté dans la base de données</center><br>';
				} else {
					echo '<center>'.mysqli_error($conn).'</center><br>';
				}
				// Déconnexion du serveur	
				mysqli_close($conn);
			}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>