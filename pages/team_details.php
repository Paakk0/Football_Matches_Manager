<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/team_details.css?v=1.0">
</head>
<body>
    <?php
    include 'navbar.php';
    include '../actions/get_table_data_functions.php';

    $conn = DatabaseConnector::connect();

    $team_id = $_GET['id_team'];
    $query = "SELECT Teams.Name as name, Leagues.Name as league, Teams.Formation as formation 
              FROM Teams 
              JOIN Leagues ON Teams.Id_League = Leagues.Id 
              WHERE Teams.Id = $team_id";
    $result = mysqli_query($conn, $query);
    $team = mysqli_fetch_assoc($result);

    $stats_query = "SELECT Wins, Losses, Draws FROM Teams WHERE Id = $team_id";
    $stats_result = mysqli_query($conn, $stats_query);
    $stats = mysqli_fetch_assoc($stats_result);

    $players_query = "SELECT * FROM player WHERE Id_Team = $team_id";
    $players_result = mysqli_query($conn, $players_query);
    ?>
    <div class="container">
        <div class="team-header">
            <h1 class="team-name"><?php echo $team['name']; ?></h1>
            <p class="team-league">League: <?php echo $team['league']; ?></p>
            <p class="team-formation">Formation: <?php echo $team['formation']; ?></p>
        </div>
        
        <div class="team-stats">
            <h2>Statistics</h2>
            <div class="stats-info">
                <p><strong>Points:</strong> <?php echo calculatePosition($stats['Wins'],$stats['Losses'],$stats['Draws']); ?></p>
                <p><strong>Wins:</strong> <?php echo $stats['Wins']; ?></p>
                <p><strong>Losses:</strong> <?php echo $stats['Losses']; ?></p>
                <p><strong>Draws:</strong> <?php echo $stats['Draws']; ?></p>
            </div>
        </div>

        <div class="team-players">
            <h2>Players</h2>
            <ul>
                <?php while ($player = mysqli_fetch_assoc($players_result)) { ?>
                    <li class="player-item">
                        <span class="player-name"><?php echo $player['Name']; ?></span> - 
                        <span class="player-position"><?php echo $player['Position']; ?></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>
