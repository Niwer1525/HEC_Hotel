<?php $page = basename($_SERVER['PHP_SELF']);?>
<div class="menu"> <!-- début menu -->
	<ul class="menu"> <!-- Menu de navigation -->
		<li class="menu"><a 
			<?php if ($page == "list_prof.php" || $page == "insert_prof.php"|| $page == 'delete_prof.php'|| $page == 'update_prof.php'){
				echo 'class="active"';}?>
			 href="list_prof.php">Professeur</a></li>
		<li class="menu"><a 
			<?php if ($page == "list_cours.php"|| $page == "insert_cours.php"|| $page == "search_cours.php"|| $page == 'delete_cours.php'|| $page == 'update_cours.php'){
				echo 'class="active"';}?>href="list_cours.php">Cours</a></li> 
		<li class="menu"><a 
			<?php if ($page == "reporting.php"| $page == "chargeprof.php"|| $page == 'coursquadri.php'){echo 'class="active"';}?>href="reporting.php">Rapport</a></li>
		<li class="menu"><a href="signout.php">Se déconnecter</a></li>
	</ul>
	<ul class="menu_s"> <!-- Menu d'opérations -->
		<?php 
			if ($page == "list_prof.php"){
				echo '<li class="menu_s"><a href="insert_prof.php">Insérer un professeur</a></li>';
			}	
			elseif ($page == "insert_prof.php" || $page == "delete_prof.php" || $page == "update_prof.php"){
				echo '<li class="menu_s"><a href="list_prof.php">Retour aux professeurs</a></li>';
			}
			elseif ($page == "reporting.php"|| $page == "coursquadri.php" || $page == "chargeprof.php") {
				echo '<li class="menu_s"><a ';
				if ($page == "coursquadri.php"){echo 'class="active"';}
				echo ' href="coursquadri.php">CoursQuadri</a></li>';
				echo '<li class="menu_s"><a ';
				if ($page == "chargeprof.php"){echo 'class="active"';}
				echo ' href="chargeprof.php">Charge Prof</a></li>';
			}
			elseif ($page == "list_cours.php"){
				echo '<li class="menu_s"><a href="search_cours.php">Rechercher un cours</a></li>';
				echo '<li class="menu_s"><a href="insert_cours.php">Insérer un cours</a></li>';
			}		
			elseif ($page == "insert_cours.php" || $page == "delete_cours.php" || $page == "update_cours.php"|| $page == "search_cours.php"){
				echo '<li class="menu_s"><a href="list_cours.php">Retour aux cours</a></li>';
			}
		?>
	</ul>
	<br><br>
</div> <!-- fin menu-->


