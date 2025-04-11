<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League Standings</title>
    <link rel="stylesheet" href="../css/leagues.css?v=1.0">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
</head>
<body>
    <?php 
    include 'navbar.php';
    include '../actions/get_table_data_functions.php';
    $leagues = getStandings();
    ?>
    <div class="page-wrapper">
        <div class="container">
            <main class="content">
                <h1 class="page-title">🏆 League Standings</h1>

                <?php foreach ($leagues as $leagueName => $teams): ?>
                    <section class="league-card" data-league="<?php echo $leagueName; ?>">
                        <h2 class="league-name"><?php echo $leagueName; ?></h2>
                        <div class="table-wrapper">
                            <table class="league-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Team</th>
                                        <th>Wins</th>
                                        <th>Losses</th>
                                        <th>Draws</th>
                                        <th>Points</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    usort($teams, function($a, $b) {
                                        return $b['points'] - $a['points'];
                                    });
                                    
                                    foreach ($teams as $index => $team): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo $team['team_name']; ?></td>
                                            <td><?php echo $team['wins']; ?></td>
                                            <td><?php echo $team['losses']; ?></td>
                                            <td><?php echo $team['draws']; ?></td>
                                            <td class="points"><?php echo $team['points']; ?></td>
                                            <td><?php echo $team['country']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                <?php endforeach; ?>
            </main>
        </div>
    </div>
</body>
</html>
