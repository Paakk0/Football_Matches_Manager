<?php
require_once '../database/connector.php';
require_once '../actions/helper_functions.php';
require_once '../model/user.php';
require_once '../session.php';

if (!$_GET['match_id']) {
    alertAndRedirect("No match ID provided.", "admin_panel.php", "error");
}
$match_id = $_GET['match_id'];

Session::start();

$user = Session::get('user');

$conn = DatabaseConnector::connect();

if (isset($_POST['add_stats'])) {
    $goals_team1 = 0;
    $goals_team2 = 0;
    $goal_scorers = [];
    $team1_players = [];
    $team2_players = [];

    if (isset($_POST['goal_player']) && isset($_POST['goal_minute'])) {
        foreach ($_POST['goal_player'] as $key => $player_id) {
            if (!isset($goal_scorers[$player_id])) {
                $goal_scorers[$player_id] = 0;
            }
            $goal_scorers[$player_id]++;

            if (in_array($player_id, array_column($team1_players, 'Id'))) {
                $goals_team1++;
            } else {
                $goals_team2++;
            }
        }
    }

    $mvp_player = null;
    if (!empty($goal_scorers)) {
        $max_goals = max($goal_scorers);
        $top_scorers = array_keys(array_filter($goal_scorers, fn($goals) => $goals === $max_goals));
        $mvp_player = $top_scorers[array_rand($top_scorers)];
    } else {
        $query_goalkeepers = "SELECT Id FROM Player WHERE Position = 'Goalkeeper' AND (Id_Team = ? OR Id_Team = ?) ORDER BY RAND() LIMIT 1";
        $stmt_gk = $conn->prepare($query_goalkeepers);
        $stmt_gk->bind_param("ii", $match['Id_Team1'], $match['Id_Team2']);
        $stmt_gk->execute();
        $mvp_result = $stmt_gk->get_result()->fetch_assoc();
        $mvp_player = $mvp_result['Id'] ?? null;
    }

    $ball_control_team1 = 50;
    if ($goals_team1 + $goals_team2 > 0) {
        $total_goals = $goals_team1 + $goals_team2;
        $ball_control_team1 = round(($goals_team1 / $total_goals) * 100);
    }

    $stmt_stats = $conn->prepare("INSERT INTO Stats (Id_Match, Id_PlayerMVP, Ball_Control_Team1) VALUES (?, ?, ?)");
    $stmt_stats->bind_param("iii", $match_id, $mvp_player, $ball_control_team1);
    $stmt_stats->execute();
    $stats_id = $stmt_stats->insert_id;

    if (isset($_POST['goal_player']) && isset($_POST['goal_minute'])) {
        foreach ($_POST['goal_player'] as $key => $player_id) {
            $minute = $_POST['goal_minute'][$key];
            $stmt_goals = $conn->prepare("INSERT INTO Goals (Id_Stat, Id_Player, Minute) VALUES (?, ?, ?)");
            $stmt_goals->bind_param("iii", $stats_id, $player_id, $minute);
            $stmt_goals->execute();
        }
    }

    if (isset($_POST['card_player']) && isset($_POST['card_minute']) && isset($_POST['card_type'])) {
        foreach ($_POST['card_player'] as $key => $player_id) {
            $minute = $_POST['card_minute'][$key];
            $card_type = $_POST['card_type'][$key];
            $stmt_cards = $conn->prepare("INSERT INTO Cartons (Id_Stat, Id_Player, Carton, Minute) VALUES (?, ?, ?, ?)");
            $stmt_cards->bind_param("iiii", $stats_id, $player_id, $card_type, $minute);
            $stmt_cards->execute();
        }
    }

    $team1_wins = 0;
    $team2_wins = 0;
    $team1_losses = 0;
    $team2_losses = 0;
    $team1_draws = 0;
    $team2_draws = 0;

    if ($goals_team1 > $goals_team2) {
        $team1_wins = 1;
        $team2_losses = 1;
    } elseif ($goals_team1 < $goals_team2) {
        $team2_wins = 1;
        $team1_losses = 1;
    } else {
        $team1_draws = 1;
        $team2_draws = 1;
    }

    $stmt_update_team1 = $conn->prepare("UPDATE Teams SET Wins = Wins + ?, Losses = Losses + ?, Draws = Draws + ? WHERE Id = ?");
    $stmt_update_team1->bind_param("iiii", $team1_wins, $team1_losses, $team1_draws, $match['Id_Team1']);
    $stmt_update_team1->execute();

    $stmt_update_team2 = $conn->prepare("UPDATE Teams SET Wins = Wins + ?, Losses = Losses + ?, Draws = Draws + ? WHERE Id = ?");
    $stmt_update_team2->bind_param("iiii", $team2_wins, $team2_losses, $team2_draws, $match['Id_Team2']);
    $stmt_update_team2->execute();

    redirect("schedule_matches.php");
}

$query_match = "SELECT 
                    Matches.*, 
                    Team1.Name AS Team1_Name, 
                    Team2.Name AS Team2_Name
                FROM Matches
                JOIN Teams AS Team1 ON Matches.Id_Team1 = Team1.Id
                JOIN Teams AS Team2 ON Matches.Id_Team2 = Team2.Id
                WHERE Matches.Id = ?";
$stmt_match = $conn->prepare($query_match);
$stmt_match->bind_param("i", $match_id);
$stmt_match->execute();
$match = $stmt_match->get_result()->fetch_assoc();

$query_team1_players = "SELECT Id, Name FROM Player WHERE Id_Team = ?";
$stmt_team1 = $conn->prepare($query_team1_players);
$stmt_team1->bind_param("i", $match['Id_Team1']);
$stmt_team1->execute();
$team1_players = $stmt_team1->get_result()->fetch_all(MYSQLI_ASSOC);

$query_team2_players = "SELECT Id, Name FROM Player WHERE Id_Team = ?";
$stmt_team2 = $conn->prepare($query_team2_players);
$stmt_team2->bind_param("i", $match['Id_Team2']);
$stmt_team2->execute();
$team2_players = $stmt_team2->get_result()->fetch_all(MYSQLI_ASSOC);

$players = array_merge($team1_players, $team2_players);

echo '<script>';
echo 'var players = ' . json_encode($players, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ';';
echo '</script>';

$query_goals = "SELECT Id_Player, COUNT(*) AS goal_count FROM Goals WHERE Id_Stat IN (SELECT Id FROM Stats WHERE Id_Match = ?) GROUP BY Id_Player ORDER BY goal_count DESC";
$stmt_goals = $conn->prepare($query_goals);
$stmt_goals->bind_param("i", $match_id);
$stmt_goals->execute();
$goal_result = $stmt_goals->get_result()->fetch_all(MYSQLI_ASSOC);

$mvp_player = null;
if (count($goal_result) > 0) {
    $max_goals = $goal_result[0]['goal_count'];
    $possible_mvp_players = array_filter($goal_result, function($player) use ($max_goals) {
        return $player['goal_count'] == $max_goals;
    });
    $mvp_player = $possible_mvp_players[array_rand($possible_mvp_players)]['Id_Player'];
} else {
    $query_goalkeepers = "SELECT Id FROM Player WHERE Position = 'Goalkeeper' AND (Id_Team = ? OR Id_Team = ?) ORDER BY RAND() LIMIT 1";
    $stmt_goalkeepers = $conn->prepare($query_goalkeepers);
    $stmt_goalkeepers->bind_param("ii", $match['Id_Team1'], $match['Id_Team2']);
    $stmt_goalkeepers->execute();
    $goalkeeper = $stmt_goalkeepers->get_result()->fetch_assoc();
    $mvp_player = $goalkeeper['Id'] ?? null;
}

$team1_goals = array_reduce($goal_result, function ($carry, $item) use ($match) {
    return $carry + ($item['Id_Player'] == $match['Id_Team1'] ? $item['goal_count'] : 0);
}, 0);
$team2_goals = array_reduce($goal_result, function ($carry, $item) use ($match) {
    return $carry + ($item['Id_Player'] == $match['Id_Team2'] ? $item['goal_count'] : 0);
}, 0);

$ball_control_team1 = $team1_goals + $team2_goals > 0 ? round(($team1_goals / ($team1_goals + $team2_goals)) * 100) : 50;
