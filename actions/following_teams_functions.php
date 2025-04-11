<?php
include_once '../actions/helper_functions.php'; 
include_once '../database/connector.php';
include_once '../model/user.php';
include_once '../session.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['follow'])){
        followTeam($_POST['id_team']);
    }
    elseif(isset($_POST['unfollow'])){
        unfollowTeam($_POST['id_team']);
    }
}

function getFollowingTeams(){
    Session::start();
    $user = Session::get('user');
    
    $conn = DatabaseConnector::connect();
    $userId = $user->getId();
    
    $query = "SELECT Teams.Id, Teams.Name, Leagues.Name AS League, Teams.Wins, Teams.Losses 
          FROM Following_Teams 
          JOIN Teams ON Following_Teams.Id_Team = Teams.Id 
          JOIN Leagues ON Teams.Id_League = Leagues.Id
          WHERE Following_Teams.Id_User = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function unfollowTeam($teamId){
    Session::start();
    $user = Session::get('user');
    $userId = $user->getId();

    $conn = DatabaseConnector::connect();

    $query = "DELETE FROM Following_Teams WHERE Id_User=? AND Id_Team=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $teamId);

    if ($stmt->execute()){
        alertAndRedirect("Successfully removed team!","../pages/teams.php","success");
    }
    alertAndRedirect("Failed to remove team!","../pages/main.php","error");
}

function followTeam($teamId){
    Session::start();
    $user = Session::get('user');
    if (!$user) {
        alertAndRedirect("No profile to add team to!","../pages/login.php","error");
    }
    
    $conn = DatabaseConnector::connect();
    
    $userId = $user->getId();
    $teamId = $_POST['id_team'];
    
    $query = "INSERT INTO Following_Teams (Id_User, Id_Team) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $teamId);
    
    if ($stmt->execute()) {
        alertAndRedirect("Successfully added followed team!","../pages/teams.php","success");
    } else {
        alertAndRedirect("Failed to follow team!","../pages/teams.php","error");
    }
}

function isFollowing($teamId){
    $followingTeams = getFollowingTeams();
    foreach ($followingTeams as $team) {
        if ($team['Id'] == $teamId) {
            return true;
        }
    }
    return false;
}
?>
