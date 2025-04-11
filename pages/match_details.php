<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Details</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/matches.css?v=1.0">
</head>
<body>
<?php
include 'navbar.php';
include '../actions/get_table_data_functions.php';
if (isset($_GET['match_id'])) {
    $match_id = $_GET['match_id'];
    $matchDetails = getMatchDetailsById($match_id);
} else {
    echo "Invalid match ID.";
    exit;
}
?>
    <div class="container">
        <main class="content">
            <h1>Match Details</h1>
            <h2><?php echo $matchDetails['team1'] . " vs " . $matchDetails['team2']; ?> (<?php echo $matchDetails['match_date']; ?>)</h2>

            <table class="details-table">
                <tr>
                    <th>Goals by <?php echo $matchDetails['team1']; ?></th>
                    <td><?php echo $matchDetails['goals_team1']; ?></td>
                </tr>
                <tr>
                    <th>Goals by <?php echo $matchDetails['team2']; ?></th>
                    <td><?php echo $matchDetails['goals_team2']; ?></td>
                </tr>
                <tr>
                    <th>Winner</th>
                    <td><?php echo $matchDetails['winner']; ?></td>
                </tr>
            </table>

            <a href="matches.php" class="btn-back">Back to Matches</a>
        </main>
    </div>
</body>
</html>
