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
	<title>Supprimer Professeur</title>
	<!-- Fichier du LAB 7 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div> <!-- début contenu -->
			<h2 align ="center">Suppression de Professeur</h2>
			<?php
				// Tester si l'input avec la methode GET existe (matricule), s'il existe on peut demander la suppression
				if (isset($_GET['matricule'])){
					// Connexion à MySQL 
					require_once 'config.php';
					// Exécuter la requêtre DELETE 
					$sql = "DELETE FROM Professeur where matricule='".$_GET['matricule']."'";
					$result = mysqli_query($conn,$sql);	
					if ($result){
						if(mysqli_affected_rows($conn)>0) {
							echo '<center>Professeur '.$_GET['matricule'].' supprimé de la base de données</center><br>';
						}else{
							echo '<center class="alert">Le matricule '.$_GET['matricule'].' est inexistant</center><br>';
						}
					} else {
						echo '<center>'.mysqli_error($conn).'</center><br>';
					}
					//déconnexion du serveur
					mysqli_close($conn);
				} else {	
					// Si l'input matricule n'existe pas, on redirige vers list_prof.php
					header('Location: list_prof.php');
					exit();
				}
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>