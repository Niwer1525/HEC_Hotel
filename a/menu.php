<?php $page = basename($_SERVER['PHP_SELF']);?>
<div class="menu"> <!-- début menu -->
	<ul class="menu"> <!-- Menu de navigation -->
		<li class="menu"><a 
			<?php if ($page == "mes_cours.php"){echo 'class="active"';}?> href="mes_cours.php">Mes cours</a>
		</li>
		<li class="menu"><a 
			<?php if ($page == "mon_compte.php"){echo 'class="active"';}?> href="mon_compte.php">Mon compte</a>
		</li> 
		<li class="menu"><a href="signout.php">Se déconnecter</a></li>
	</ul>
	<br><br>
</div> <!-- fin menu-->