<?php
require_once '../database/connector.php';
require_once '../actions/helper_functions.php';
require_once '../model/user.php';
require_once '../session.php';

Session::start();

$user = Session::get('user');

$conn = DatabaseConnector::connect();

$teams = [];
    $query = "SELECT * FROM Teams";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row;
        }
    }

$result = $conn->query("SELECT * FROM Leagues");
$leagues = [];

while ($row = mysqli_fetch_assoc($result)) {
    $leagues[] = $row;
}

if (isset($_POST['add_team'])) {
    $team_name = $_POST['team_name'];
    $league_id = $_POST['league_id'];
    $formation = $_POST['formation'];

    if (!empty($team_name) && !empty($league_id) && !empty($formation)) {
        $query = "INSERT INTO Teams (Name, Id_League, Formation) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sis", $team_name, $league_id, $formation);

        if ($stmt->execute()) {
            redirect("../pages/manage_teams.php");
        } else {
            alertAndRedirect("Error adding team!","manage_teams.php","error");
        }
    }
}

if (isset($_POST['update_team'])) {
    $team_id = $_POST['id'];
    $team_name = $_POST['team_name'];
    $league_id = $_POST['league_id'];
    $formation = $_POST['formation'];

    if (!empty($team_name) && !empty($league_id) && !empty($formation)) {
        $query = "UPDATE Teams SET Name = ?, Id_League = ?, Formation = ? WHERE Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sisi", $team_name, $league_id, $formation, $team_id);

        if ($stmt->execute()) {
            redirect("../pages/manage_teams.php");
        } else {
            alertAndRedirect("Error updating team!","manage_teams.php","error");
        }
    }
}

if (isset($_POST['delete_team'])) {
    $team_id = $_POST['id'];

    $query = "DELETE FROM Teams WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $team_id);
    if ($stmt->execute()) {
        redirect("../pages/manage_teams.php");
    } else {
        alertAndRedirect("Error deleting team!","manage_teams.php","error");
    }
}
?>
