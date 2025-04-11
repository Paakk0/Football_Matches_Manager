<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/teams.css?v=1.2">
</head>
<body>
    <?php 
    include 'navbar.php';
    include '../actions/get_table_data_functions.php';
    $teams = getTeams();
    ?>

    <div class="page-wrapper">
        <h1 class="page-title">⚽ Teams</h1>
        <div class="teams-container">
            <?php foreach ($teams as $team): ?>
                <div class="team-card" data-formation="<?php echo $team['formation']; ?>">
                    <?php if($user): 
                        include_once '../actions/following_teams_functions.php';
                        if(!isFollowing($team['id'])):
                    ?>
                        <form action="../actions/following_teams_functions.php" method="POST">
                            <input type="hidden" name="id_team" value="<?php echo $team['id']; ?>">
                            <button type="submit" name="follow" class="follow-button">Follow</button>
                        </form>
                    <?php endif; endif; ?>
                    <br>
                    <h2 class="team-name">
                        <a href="team_details.php?id_team=<?php echo $team['id']?>"> <?php echo $team['name']; ?> </a>
                    </h2>
                    <p class="team-country"> <?php echo $team['country']; ?> </p>
                    
                    <br>
                    <h2>Formation: <?php echo $team['formation']?></h2>

                    <div class="formation-visual">
                        <canvas id="formation-<?php echo $team['id']; ?>" width="400" height="250"></canvas>
                    </div>

                    <br>
                    <h3>Players:</h3>
                    <ul>
                        <?php foreach ($team['players'] as $player): ?>
                            <li><?php echo $player['name'] . ' - ' . $player['position']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        window.teams = <?php echo json_encode($teams, JSON_PRETTY_PRINT); ?>;
    </script>
    <script src="../js/draw_formation.js"></script>
</body>
</html>
