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
	<title>Modifier Cours</title>
	<!-- Fichier de l'ex 3 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div> <!-- début contenu -->
			<h2 align="center"> Modifier Cours</h2>

			<?php
				// Tester si l'input avec la methode GET existe (code), s'il existe on peut demander la mise à jour, sinon on redirige vers list_cours.php
				if (isset($_GET['code'])){
					// Connexion à MySQL 
					require_once 'config.php';
					//Etape 1: Récupérer les informations de ce code (faire un SELECT)	
					$code = $_GET['code'];
					$sql = "SELECT * FROM Cours WHERE code = '".$code."'";
					$result = mysqli_query($conn,$sql);
					$nbLignes = mysqli_num_rows($result);

					if ($nbLignes == 0){
						die("<center class=\"alert\">Le code '$code' n'existe pas.</center>");
					} else {
						$row = mysqli_fetch_array($result);
						$intitule = $row['intitule'];
						$credits = $row['credits'];
						$nbreHeures = $row['nbreHeures'];
						$quadrimestre = $row['quadrimestre'];
						$matricule = $row['matricule'];
					}
					
					//Etape 2: Traiter l'info si l'utilisateur clique sur le bouton Modifier
					if (isset($_POST['save_btn'])){
						$intitule = $_POST['intitule'];
						$credits = $_POST['credits'];
						$nbreHeures = $_POST['nbreHeures'];
						$quadrimestre = $_POST['quadrimestre'];
						$matricule = $_POST['matricule'];
						// Pas besoin de vérifier la qualité des données (comme dans insert_prof.php) car ajout de l'attribut required dans le formulaire
						// Requête UPDATE 
						$sqlUpDate = "UPDATE Cours SET intitule='".$intitule."', credits='".$credits."', nbreHeures='".$nbreHeures."', quadrimestre='".$quadrimestre."', matricule='".$matricule."' WHERE code='".$code."'";
						if (!mysqli_query($conn, $sqlUpDate)) {
							die('Erreur:'.mysqli_error($conn));
						}else{
							echo "<center>Le cours $code a bien été modifié dans la base de données.</center>";
						}
					}
					
					//Afficher l'information du cours avec ce code dans le formulaire
					echo '<form name="cours_update" action="update_cours.php?code='.$code.'" method="post">';
					echo '<table align="center">';
					echo '<tr><td align=right>Code: </td><td>'.$code.'<input type="hidden" name="code" value="'.$code.'"></td></tr>'; 
					echo '<tr><td align=right>Intitulé: </td><td><input type="text" name="intitule" value="'.$intitule.'" required></td></tr>'; 
					echo '<tr><td align=right>Credits: </td><td><input type="text" name="credits" value="'.$credits.'" required></td></tr>';
					echo '<tr><td align=right>Nombre d\'heures: </td><td><input type="text" name="nbreHeures" value="'.$nbreHeures.'" required></td></tr>';
					echo '<tr><td align=right>Quadrimestre: </td><td><select name="quadrimestre" value="'.$quadrimestre.'">';
						// afficher les options pour le quadrimestre (Q1, Q2, TA) 
						$list_quadrimestre = array("Q1","Q2","TA");
						for ($i=0;$i<sizeof($list_quadrimestre);$i++){
							if ($list_quadrimestre[$i] == $quadrimestre){  // si c'est initialement le quadrimestre du cours --> selected
								echo '<option value="'.$list_quadrimestre[$i].'" selected>'.$list_quadrimestre[$i].'</option>';
							}else{
								echo '<option value="'.$list_quadrimestre[$i].'">'.$list_quadrimestre[$i].'</option>';
							}
						}
					echo '</select></td></tr>';	

					echo '<tr><td align=right>Titulaire: </td><td><select name="matricule" value="'.$matricule.'">';
						
						// Afficher les options pour les titulaires : NULL ou un des profs de notre DB
						echo  '<option value="NULL"></option>'; // Il faut permettre de ne pas assigner le cours à un titulaire 
						// Configuration pour connecter à la base de donnée
						require_once 'config.php';
						// Requête SELECT pour avoir la liste des professeurs (nom, prénom et matricule par ordre alphabétique)
						$sqlProf = "SELECT DISTINCT nom, prenom, matricule FROM Professeur ORDER BY nom, prenom";
						$resultProf = mysqli_query($conn, $sqlProf);
						// Afficher le menu déroulant avec les profs
						while($row = mysqli_fetch_array($resultProf)){
							// Afficher par défaut le titulaire actuel du cours --> selected
							if ($row['matricule'] == $matricule){ 
								echo '<option value="'.$row['matricule'].'" selected>'.$row['nom'].' '.$row['prenom'].' ('.$row['matricule'].')</option>';
							}else{ 
								echo '<option value="'.$row['matricule'].'">'.$row['nom'].' '.$row['prenom'].' ('.$row['matricule'].')</option>';
							}
						}
						// Déconnexion du serveur
						mysqli_close($conn);
							
					echo '</select></td></tr>';			
					echo '<tr><td align=right><input type="submit" name="save_btn" value="Modifier"></td><td><input type="reset" name="res_btn" value="Réinitialiser"></td></tr>';
					echo '</table>';
					echo '</form>';						
				}else{  
					// Si l'input du code n'existe pas, on redirige vers la liste des cours
					header('Location: list_cours.php');
					exit();
				}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>