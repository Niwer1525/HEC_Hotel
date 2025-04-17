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
	<title>Reporting</title>
	<!-- Fichier du LAB 8 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">	
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div>  <!-- début contenu -->
			<?php
				// Connexion à MySQL 
				require_once 'config.php';
				//A remplir, une requêtre permettant de compter le nombres de cours, crédits et heures en Q1, Q2 et TA
				$sql = "SELECT quadrimestre, count(code) as 'nbreCours', sum(credits) as 'credits', sum(nbreHeures) as 'nbreHeures' FROM Cours GROUP BY quadrimestre";
				$result = mysqli_query($conn,$sql);

				echo '<table width="200" class="list">';
				echo '<th>Quadrimestre</th><th>Nombre Cours</th><th>Nombre Credits</th><th>Nombre Heures</th>';
				while($row = mysqli_fetch_array($result)){
					echo '<tr class="list">';
					echo '<td class="list" >'.$row['quadrimestre'].' </td>';
					echo '<td class="list" >'.$row['nbreCours'].'</td>';
					echo '<td class="list" >'.$row['credits'].'</td>';
					echo '<td class="list" >'.$row['nbreHeures'].'</td>';
					echo '</tr>';
				}	
				echo '</table>';
				mysqli_close($conn);
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>