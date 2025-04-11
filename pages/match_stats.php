<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Match Statistics</title>
    <link rel="stylesheet" href="../css/match_stats.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">    
</head>
<body>
    <?php 
    include 'navbar.php'; 
    include '../actions/get_match_stats.php';
    ?>

    <div class="container">
        <h1>Match Statistics</h1>

        <div class="match-info">
            <p><strong>Match Date:</strong> <?php echo htmlspecialchars($match['Date']); ?></p>
            <p><strong>Team 1:</strong> <?php echo htmlspecialchars($match['Team1Name']); ?></p>
            <p><strong>Team 2:</strong> <?php echo htmlspecialchars($match['Team2Name']); ?></p>
            <p><strong>Score:</strong> 
                <?php echo htmlspecialchars($team1_goals) . " - " . htmlspecialchars($team2_goals); ?>
            </p>
            <p><strong>Ball Control for Team 1:</strong> <?php echo htmlspecialchars($match['Ball_Control_Team1']); ?>%</p>
            <p><strong>Ball Control for Team 2:</strong> <?php echo htmlspecialchars(100 - $match['Ball_Control_Team1']); ?>%</p>
            <p><strong>Most Valuable Player:</strong> <?php echo htmlspecialchars($match['Players_Team'] . " - " . $match['Player_Name'] . " - " . $match['Player_Position']); ?></p>
        </div>

        <h2>Goals Scored:</h2>
        <ul>
            <?php if (!empty($goals)) : ?>
                <?php foreach ($goals as $goal) : ?>
                    <li>
                        <span class="player"><?php echo htmlspecialchars($goal["TeamName"] . " - " . $goal['player_name']); ?></span> 
                        <span class="time"><?php echo htmlspecialchars($goal['minute']); ?>'</span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="no-records">No goals scored in this match.</li>
            <?php endif; ?>
        </ul>

        <h2>Cards Given:</h2>
        <ul>
            <?php if (!empty($cartons)) : ?>
                <?php foreach ($cartons as $carton) : ?>
                    <li>
                        <span class="player"><?php echo htmlspecialchars($carton["TeamName"] . " - " . $carton['player_name']); ?></span> 
                        <span class="card-type"><?php echo htmlspecialchars($carton['carton'] == 1 ? "Yellow" : "Red"); ?></span>
                        <span class="time"><?php echo htmlspecialchars($carton['minute']); ?>'</span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="no-records">No cards given in this match.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
