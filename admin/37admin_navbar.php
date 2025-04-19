<ul>
    <li>
        <a href="37admin_client.php" <?php if($page == "admin_client") echo 'class="active"'; ?>>Clients</a>
    </li> 
    <li>
        <a href="37admin_room_type.php" <?php if($page == "admin_room_type") echo 'class="active"'; ?>>Type chambre</a>
    </li>
    <li>
        <a href="37admin_room.php" <?php if($page == "admin_room") echo 'class="active"'; ?>>Chambres</a>
    </li>
    <li>
        <a href="37admin_booking.php" <?php if($page == "admin_booking") echo 'class="active"'; ?>>Réservations</a>
    </li>
    <li>
        <a href="37admin_stats.php" <?php if($page == "admin_stats") echo 'class="active"'; ?>>Statistiques</a>
    </li>
    <li>
        <a href="../37disconnect.php" class="danger">Se déconnecter</a>
    </li>
</ul>