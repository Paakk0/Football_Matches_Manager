<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Teams</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.1">
    <link rel="stylesheet" href="../css/following_teams.css?v=1.1">
</head>
<body>
    <?php 
    include 'navbar.php'; 
    include_once '../actions/following_teams_functions.php';
    $followingTeams = getFollowingTeams();
    ?>

    <div class="container">
        <h1>My Followed Teams</h1>

        <?php if (!empty($followingTeams)): ?>
            <div class="teams-grid">
                <?php foreach ($followingTeams as $team): ?>
                    <div class="team-card">
                        <h2><?php echo htmlspecialchars($team['Name']); ?></h2>
                        <p><strong>League:</strong> <?php echo htmlspecialchars($team['League']); ?></p>
                        <p><strong>Wins:</strong> <?php echo htmlspecialchars($team['Wins']); ?></p>
                        <p><strong>Losses:</strong> <?php echo htmlspecialchars($team['Losses']); ?></p>
                        <a href="team_details.php?id_team=<?php echo $team['Id']; ?>" class="details-button">View Details</a>
                        <form action="../actions/following_teams_functions.php" method="post">
                            <input type="hidden" name="id_team" value="<?php echo htmlspecialchars($team['Id']); ?>">
                            <input type="submit" name="unfollow" class="unfollow-button" value="Unfollow">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-teams">You are not following any teams.</p>
        <?php endif; ?>
    </div>
</body>
</html>
