<?php
require_once '../database/connector.php';
require_once '../actions/helper_functions.php';
require_once '../model/user.php';
require_once '../session.php';

Session::start();

$user = Session::get('user');

$conn = DatabaseConnector::connect();

$result = $conn->query("SELECT Id, Name FROM Teams");
$teams = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM Player");
$players = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['add_player'])) {
    $name = $_POST['player_name'];
    $team_id = $_POST['team_id'];
    $position = $_POST['position'];

    $stmt = $conn->prepare("INSERT INTO Player (Name, Id_Team, Position) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $team_id, $position);
    $stmt->execute();
    redirect("../pages/manage_players.php");
}

if (isset($_POST['update_player'])) {
    $id = $_POST['id'];
    $name = $_POST['player_name'];
    $team_id = $_POST['team_id'];
    $position = $_POST['position'];
    $stmt = $conn->prepare("UPDATE Player SET Name=?, Id_Team=?, Position=? WHERE Id=?");
    $stmt->bind_param("sisi", $name, $team_id, $position, $id);
    $stmt->execute();
    redirect("../pages/manage_players.php");
}

if (isset($_POST['delete_player'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM Player WHERE Id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    redirect("../pages/manage_players.php");
}

$conn->close();
?>
