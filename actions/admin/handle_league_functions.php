<?php
require_once '../database/connector.php';
require_once '../actions/helper_functions.php';
require_once '../model/user.php';
require_once '../session.php';

Session::start();

$user = Session::get('user');

$conn = DatabaseConnector::connect();

$query = "
    SELECT L.Id, L.Name, COUNT(T.Id) AS Team_Count 
    FROM Leagues L
    LEFT JOIN Teams T ON L.Id = T.Id_League
    GROUP BY L.Id, L.Name
";

$result = $conn->query($query);
$leagues = [];

while ($row = mysqli_fetch_assoc($result)) {
    $leagues[] = $row;
}

$result = $conn->query("SELECT Id, Name FROM Teams");
$teams=[];
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $teams[] = $row;
}

if (isset($_POST['add_league'])) {
    $leagueName = trim($_POST['league_name']);

    if (!empty($leagueName)) {
        $stmt = $conn->prepare("INSERT INTO Leagues (Name) VALUES (?)");
        $stmt->bind_param("s", $leagueName);
        $stmt->execute();
        redirect("../pages/manage_leagues.php");
    }
}

if (isset($_POST['update_league'])) {
    $leagueId = $_POST['id'];
    $leagueName = trim($_POST['league_name']);

    if (!empty($leagueId) && !empty($leagueName)) {
        $stmt = $conn->prepare("UPDATE Leagues SET Name = ? WHERE Id = ?");
        $stmt->bind_param("si", $leagueName, $leagueId);
        $stmt->execute();
        redirect("../pages/manage_leagues.php");
    }
}

if (isset($_POST['delete_league'])) {
    $leagueId = $_POST['id'];

    if (!empty($leagueId)) {
        $stmt = $conn->prepare("DELETE FROM Leagues WHERE Id = ?");
        $stmt->bind_param("i", $leagueId);
        $stmt->execute();
        redirect("../pages/manage_leagues.php");
    }
}

if (isset($_POST['add_team_to_league'])) {
    $teamId = $_POST['team_id'];
    $leagueId = $_POST['league_id'];

    if (!empty($teamId) && !empty($leagueId)) {
        $stmt = $conn->prepare("UPDATE Teams SET Id_League = ? WHERE Id = ?");
        $stmt->bind_param("ii", $leagueId, $teamId);
        $stmt->execute();
        redirect("../pages/manage_leagues.php");
    }
}

$conn->close();
?>