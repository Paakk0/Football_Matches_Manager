<?php
require_once '../Database/DatabaseConnector.php';
require_once '../SessionManager.php';
require_once '../HelperFunctions.php';

SessionManager::start();

if (!isset($_GET['id_match']) || !is_numeric($_GET['id_match'])) {
    createAlert('Invalid match ID.');
    redirectTo('Main.php');
    exit();
}

$id_match = intval($_GET['id_match']);

$conn = DatabaseConnector::getConnection();
$sql = "SELECT Matches.*, 
               Team1.Name AS Team1Name, 
               Team2.Name AS Team2Name, 
               Stats.Ball_Control_Team1, 
               Player.Name AS MVPName 
        FROM Matches 
        JOIN Teams AS Team1 ON Matches.Id_Team1 = Team1.Id 
        JOIN Teams AS Team2 ON Matches.Id_Team2 = Team2.Id 
        JOIN Stats ON Matches.Id_Stats = Stats.Id 
        JOIN Player ON Stats.Id_PlayerMVP = Player.Id 
        WHERE Matches.Id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_match);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $match = $result->fetch_assoc();
} else {
    createAlert('Match not found.');
    redirectTo('index.php');
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Match Statistics</title>
    <link rel="stylesheet" href="./css/viewstats.css">
</head>
<body>
    <?php include 'Navigation.php'; ?>
    <h1>Match Statistics</h1>
    <p><strong>Match Date:</strong> <?php echo htmlspecialchars($match['Date']); ?></p>
    <p><strong>Team 1:</strong> <?php echo htmlspecialchars($match['Team1Name']); ?></p>
    <p><strong>Team 2:</strong> <?php echo htmlspecialchars($match['Team2Name']); ?></p>
    <p><strong>Ball Control Team 1:</strong> <?php echo htmlspecialchars($match['Ball_Control_Team1']); ?>%</p>
    <p><strong>MVP Player:</strong> <?php echo htmlspecialchars($match['MVPName']); ?></p>
</body>
</html>