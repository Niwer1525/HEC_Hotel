<?php 
    $page = basename($_SERVER['PHP_SELF']); // Obtenir le nom de la page courante
?>
<div class="menu">
    <ul>
        <li><a href="index.php" <?php if($page == 'index.php') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="about.php" <?php if($page == 'about.php') echo 'class="active"'; ?>>About</a></li>
        <li><a href="contact.php" <?php if($page == 'contact.php') echo 'class="active"'; ?>>Contact</a></li>
    </ul>
</div>