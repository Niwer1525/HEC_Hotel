<?php
	session_start();
	//si le nom de l'utilisateur n'est pas défini, il demande de s'authentifier sur login.php
	if (!(isset($_SESSION['username']))) {
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistiques</title>
	<!-- Fichier du LAB 8 -->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="contenant"><!-- début contenant -->		
		<?php include 'menu.php'; ?>
		<div>  <!-- début contenu -->
			<h2 align="center"> Statistiques des réservations </h2>
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
				//A remplir: une requête permettant de compter le nombre de cours et heures des professeurs
				$marequete = "SELECT cl.id_client, cl.nom, cl.prenom, COUNT(*) AS nb_reservations,
					SUM(DATEDIFF(r.date_fin, r.date_debut) * t.prix_nuit_pers * r.nbre_pers) AS total
					FROM client cl
					JOIN reservation r ON cl.id_client = r.id_client
					JOIN chambre ch ON r.id_chambre = ch.id_chambre
					JOIN type_chambre t ON ch.id_type_chambre = t.id_type_chambre
					GROUP BY cl.id_client";
				$result=mysqli_query($conn,$marequete);

				echo '<table class="list">';
				echo '<th>Client</th><th>Nom</th><th>Prénom</th><th>Nombre Réservations</th><th>Total</th>';
				while($row = mysqli_fetch_array($result)){
					echo '<tr class="list">';
					echo '<td class="list" >'.$row['id_client'].' </td>';
					echo '<td class="list" >'.$row['nom'].'</td>';
					echo '<td class="list" >'.$row['prenom'].'</td>';
					echo '<td class="list" >'.$row['nb_reservations'].'</td>';
					echo '<td class="list" >'.number_format($row['total'],2,',',' ').'</td>';
					echo '</tr>';
				}	
				echo '</table>';
				mysqli_close($conn);
				
			?>
		</div> <!-- fin contenu -->		
	</div><!-- fin contenant -->
</body>
</html>