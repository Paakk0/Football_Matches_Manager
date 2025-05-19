<?php
require_once '../database/connector.php';
require_once '../actions/helper_functions.php';
require_once '../model/user.php';
require_once '../session.php';

Session::start();

$user = Session::get('user');

$conn = DatabaseConnector::connect();

$query = "SELECT Matches.Id, 
                 Matches.Id_Team1 AS Id_Team1,
                 Matches.Id_Team2 AS Id_Team2,
                 Team1.Name AS HomeTeam, 
                 Team2.Name AS AwayTeam,
                 Matches.Date AS Date,
                 Leagues.Name AS League
          FROM Matches
          JOIN Teams AS Team1 ON Matches.Id_Team1 = Team1.Id
          JOIN Teams AS Team2 ON Matches.Id_Team2 = Team2.Id
          JOIN Leagues ON Team1.Id_League = Leagues.Id
          ORDER BY Date DESC";
$result = $conn->query($query);
$matches = $result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT Id, Name FROM Teams";
$teams_result = $conn->query($query);
$teams = $teams_result->fetch_all(MYSQLI_ASSOC);

$current_datetime = new DateTime();

$past_matches = [];
$future_matches = [];

foreach ($matches as $match) {
    $match_datetime = new DateTime($match['Date']);
    if ($match_datetime < $current_datetime) {
        $past_matches[] = $match;
    } else {
        $future_matches[] = $match;
    }
}

if (isset($_POST['add_match'])) {
    $home_team = $_POST['team1_id'];
    $away_team = $_POST['team2_id'];
    $date_input = $_POST['match_date'];

    $date = date('Y-m-d H:i:s', strtotime($date_input));

    if ($home_team == $away_team) {
        alertAndRedirect("A team cannot play against itself!", "schedule_matches.php", "error");
    }

    $stmt = $conn->prepare("INSERT INTO Matches (Id_Team1, Id_Team2, Date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $home_team, $away_team, $date);
    $stmt->execute();
    redirect("schedule_matches.php");
}

if (isset($_POST['update_match'])) {
    $match_id = $_POST['id'];
    $home_team = $_POST['team1_id'];
    $away_team = $_POST['team2_id'];
    $date_input = $_POST['match_date'];

    $date = date('Y-m-d H:i:s', strtotime($date_input));

    if ($home_team == $away_team) {
        alertAndRedirect("A team cannot play against itself!", "schedule_matches.php", "error");
    }

    $stmt = $conn->prepare("UPDATE Matches SET Id_Team1 = ?, Id_Team2 = ?, Date = ? WHERE Id = ?");
    $stmt->bind_param("iisi", $home_team, $away_team, $date, $match_id);
    $stmt->execute();
    redirect("schedule_matches.php");
}

if (isset($_POST['delete_match'])) {
    $match_id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM Matches WHERE Id = ?");
    $stmt->bind_param("i", $match_id);
    $stmt->execute();
    redirect("schedule_matches.php");
}
?>
