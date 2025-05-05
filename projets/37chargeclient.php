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
	<title>Statistiques Réservations</title>
	<!-- Fichier du LAB 8 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">	
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div>  <!-- début contenu -->
			<?php
				// Connexion à MySQL sans devoir à nouveau encoder les infos 
				$servername = $_SERVER['SERVER_NAME'];
				$username = $_SERVER['DB_USER'];  
				$password = $_SERVER['DB_PASS'];
				$dbname="mschyns_$username";
				$conn=mysqli_connect($servername, $username, $password,$dbname);
				// Vérifier l'état de la connexion
				if(!$conn){
					die("Connexion non réussie : " . mysqli_connect_error());
				}
				//A remplir, une requête permettant de compter nombre de cours, crédits et heures en Q1, Q2 et TA
				$marequete = "SELECT typeChambre, COUNT(*) AS nbReservations, 
							  SUM(nbNuits) AS totalNuits, SUM(montant) AS totalMontant
							  FROM Reservation
							  GROUP BY typeChambre";
				$result = mysqli_query($conn,$marequete);
				echo '<table width="200" class="list">';
				echo '<th>Quadrimestre</th><th>Nombre Cours</th><th>Nombre Credits</th><th>Nombre Heures</th>';
				while($row = mysqli_fetch_array($result)){
					echo '<tr class="list">';
					echo '<td class="list" >'.$row['typeChambre'].' </td>';
					echo '<td class="list" >'.$row['nbReservations'].'</td>';
					echo '<td class="list" >'.$row['totalNuits'].'</td>';
					echo '<td class="list" >'.number_format($row['totalMontant'],2, ',', ' ').'</td>';
					echo '</tr>';
				}	
				echo '</table>';
				mysqli_close($conn);
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>