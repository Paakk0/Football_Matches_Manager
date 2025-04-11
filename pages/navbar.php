<?php
include '../database/connector.php';
include '../model/user.php';
include '../actions/helper_functions.php';
include '../session.php';
Session::start();
$user=Session::get('user');
?>

<nav class="sidebar">
    <h2 class="title"><a href="home.php">Home</a></h2>
    <button class="menu-toggle" id="menuButton">☰ Menu</button>
    <ul class="nav-items">
        <li><a href="leagues.php">🏆 Standings</a></li>
        <li><a href="matches.php">📅 Matches</a></li>
        <li><a href="teams.php">⚽ Teams</a></li>
    </ul>
    
    <ul class="dropdown-menu" id="dropdownMenu">
        <?php if($user):?>
            <li><a href="profile.php">🗿 Profile</a></li>
            <li><a href="following_teams.php">⚽ My Teams</a></li>
            <?php if($user->getRole()): ?>
                <li><a href="admin_panel.php">🛠️ Admin Panel</a></li>
            <?php endif; ?>
            <li><a href="../actions/logout.php">🚪 Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">🔑 Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
<script src="../js/navbar.js"></script>