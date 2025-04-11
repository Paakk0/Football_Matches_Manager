<?php 
require_once '../database/connector.php';
require_once '../session.php';

Session::start();

if (!isset($_GET['id_match']) || !is_numeric($_GET['id_match'])) {
    alertAndRedirect("Invalid match ID.","matches.php","error");
}

$id_match = intval($_GET['id_match']);

$conn = DatabaseConnector::connect();
$sql = "SELECT Matches.*, 
               Team1.Name AS Team1Name, 
               Team2.Name AS Team2Name, 
               Stats.Ball_Control_Team1, 
               PlayersTeam.Name As Players_Team,
               Player.Name AS Player_Name,
               Player.Position AS Player_Position,
               Stats.Id AS Id_Stat
        FROM Matches 
        JOIN Teams AS Team1 ON Matches.Id_Team1 = Team1.Id 
        JOIN Teams AS Team2 ON Matches.Id_Team2 = Team2.Id 
        JOIN Stats ON Matches.Id = Stats.Id_Match 
        JOIN Player ON Stats.Id_PlayerMVP = Player.Id 
        JOIN Teams AS PlayersTeam ON Player.Id_Team = PlayersTeam.Id
        WHERE Matches.Id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_match);
$stmt->execute();
$result = $stmt->get_result();

$match = $result->fetch_assoc();

$statId = $match['Id_Stat'];

$sql = "SELECT  
                Goals.Minute As minute,
                Player.Name AS player_name,
                Player.Position AS player_position,
                PlayerTeam.Name AS TeamName
        FROM Goals
        JOIN Player ON Player.Id = Goals.Id_Player
        JOIN Teams AS PlayerTeam ON PlayerTeam.Id = Player.Id_Team
        WHERE Id_Stat = ?
        ORDER BY minute";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $statId);
$stmt->execute();
$result = $stmt->get_result();
$goals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $goals[] = $row;
    }
}

$sql = "SELECT 
                Cartons.Carton AS carton,
                Cartons.Minute As minute,
                Player.Name AS player_name,
                Player.Position AS player_position,
                PlayerTeam.Name AS TeamName
        FROM Cartons
        JOIN Player ON Player.Id = Cartons.Id_Player
        JOIN Teams AS PlayerTeam ON PlayerTeam.Id = Player.Id
        WHERE Id_Stat = ?
        ORDER BY minute";


$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $statId);
$stmt->execute();
$result = $stmt->get_result();
$cartons = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartons[] = $row;
    }
}

$sql_goals_team1 = "SELECT COUNT(*) AS Team1Goals FROM Goals JOIN Player ON Player.Id = Goals.Id_Player WHERE Goals.Id_Stat = ? AND Player.Id_Team = ?";
$stmt = $conn->prepare($sql_goals_team1);
$stmt->bind_param('ii', $statId, $match['Id_Team1']);
$stmt->execute();
$result = $stmt->get_result();
$team1_goals = $result->fetch_assoc()['Team1Goals'];

$sql_goals_team2 = "SELECT COUNT(*) AS Team2Goals FROM Goals JOIN Player ON Player.Id = Goals.Id_Player WHERE Goals.Id_Stat = ? AND Player.Id_Team = ?";
$stmt = $conn->prepare($sql_goals_team2);
$stmt->bind_param('ii', $statId, $match['Id_Team2']);
$stmt->execute();
$result = $stmt->get_result();
$team2_goals = $result->fetch_assoc()['Team2Goals'];



$stmt->close();
$conn->close();
?>