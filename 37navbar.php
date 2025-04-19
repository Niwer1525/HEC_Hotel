<ul> <!-- Liste des pages connexion/inscription du site -->
    <li> <!-- élément de liste -->
        <a href="37signup.php" <?php if($page == 'signup') echo 'class="active"'; ?>>S'enregistrer</a>
    </li>
    <li>
        <a href="37login.php" <?php if($page == 'login') echo 'class="active"'; ?>>Se connecter</a>
    </li>
</ul>