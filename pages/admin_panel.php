<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin_panel.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
</head>
<body>
    <?php 
    include_once 'Navbar.php'; 
    $user = Session::get('user');
    if(!$user->getRole()){
        alertAndRedirect("You are not supposed to be here!","home.php","error");
    }
    ?>
    <div class="admin-container">
        <h1>Admin Panel</h1>
        <p>Welcome, <?php echo htmlspecialchars($user->getName()); ?>!</p>

        <div class="admin-actions">
            <a href="manage_users.php" class="admin-button">Manage Users</a>
            <a href="manage_leagues.php" class="admin-button">Manage Leagues</a>
            <a href="manage_teams.php" class="admin-button">Manage Teams</a>
            <a href="manage_players.php" class="admin-button">Manage Players</a>
            <a href="schedule_matches.php" class="admin-button">Schedule Matches</a>
        </div>
    </div>
</body>
</html>