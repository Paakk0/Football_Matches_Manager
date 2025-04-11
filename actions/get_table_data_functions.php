<?php
require_once '../database/connector.php';

function getStandings() {
    $conn = DatabaseConnector::connect();

    $result = $conn->query("
        SELECT 
            Leagues.Id AS league_id,
            Leagues.Name AS league_name,
            Teams.Id AS team_id,
            Teams.Name AS team_name,
            Teams.Country AS country,
            Teams.Formation AS formation,
            Teams.Wins AS wins,
            Teams.Losses AS losses,
            Teams.Draws AS draws
        FROM 
            Leagues
        JOIN 
            Teams ON Leagues.Id = Teams.Id_League;
    ");

    $leagues = [];

    while ($row = $result->fetch_assoc()) {
        $leagueName = $row['league_name'];

        if (!isset($leagues[$leagueName])) {
            $leagues[$leagueName] = [];
        }

        $leagues[$leagueName][] = [
            'team_id'   => $row['team_id'],
            'team_name' => $row['team_name'],
            'country'   => $row['country'],
            'wins'      => $row['wins'],
            'losses'    => $row['losses'],
            'draws'     => $row['draws'],
            'points'    => calculatePosition($row['wins'], $row['losses'], $row['draws']),
        ];
    }

    return $leagues;
}


function getLeagues() {
    $conn = DatabaseConnector::connect();
    $result = $conn->query("SELECT Leagues.Name as league, Teams.Name as team, Teams.Country as country 
                            FROM Leagues 
                            JOIN Teams ON Leagues.Id = Teams.Id_League");

    $leagues = [];
    while ($row = $result->fetch_assoc()) {
        $leagues[$row['league']][] = [
            'team' => $row['team'],
            'country' => $row['country']
        ];
    }

    return $leagues;
}


function getMatches($league = null, $team = null, $country = null, $dateFilter = null, $startDate = null) {
    $conn = DatabaseConnector::connect();

    $sql = "SELECT 
                Matches.Id as match_id, 
                Matches.Date as match_date, 
                Team1.Name as team1, 
                Team2.Name as team2, 
                Team1.Country as country1, 
                Team2.Country as country2,
                SUM(CASE WHEN Goals.Id_Player = Team1.Id THEN 1 ELSE 0 END) AS goals_team1,
                SUM(CASE WHEN Goals.Id_Player = Team2.Id THEN 1 ELSE 0 END) AS goals_team2
            FROM Matches
            JOIN Teams as Team1 ON Matches.Id_Team1 = Team1.Id
            JOIN Teams as Team2 ON Matches.Id_Team2 = Team2.Id
            LEFT JOIN Goals ON Goals.Id_Stat = Matches.Id
            WHERE 1=1 ";

    if ($league) {
        $sql .= " AND Team1.Id_League = (SELECT Id FROM Leagues WHERE Name = '$league') ";
        $sql .= " AND Team2.Id_League = (SELECT Id FROM Leagues WHERE Name = '$league') ";
    }

    if ($team) {
        $sql .= " AND (Team1.Name = '$team' OR Team2.Name = '$team') ";
    }

    if ($country) {
        $sql .= " AND (Team1.Country LIKE '%$country%' OR Team2.Country LIKE '%$country%') ";
    }

    if ($dateFilter) {
        if ($dateFilter == 'before' && $startDate) {
            $sql .= " AND Matches.Date < '$startDate' ";
        } elseif ($dateFilter == 'after' && $startDate) {
            $sql .= " AND Matches.Date > '$startDate' ";
        }
    }

    $sql .= " GROUP BY Matches.Id, Team1.Name, Team2.Name, Team1.Country, Team2.Country, Matches.Date
              ORDER BY Matches.Date DESC";

    $result = $conn->query($sql);

    $matches = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['goals_team1'] > $row['goals_team2']) {
            $winner = $row['team1'];
        } elseif ($row['goals_team1'] < $row['goals_team2']) {
            $winner = $row['team2'];
        } else {
            $winner = "Draw";
        }

        $matches[] = [
            'match_id' => $row['match_id'],
            'match_date' => $row['match_date'],
            'team1' => $row['team1'],
            'team2' => $row['team2'],
            'country1' => $row['country1'],
            'country2' => $row['country2'],
            'goals_team1' => $row['goals_team1'],
            'goals_team2' => $row['goals_team2'],
            'winner' => $winner
        ];
    }

    return $matches;
}

function getMatchDetailsById($match_id) {
    $conn = DatabaseConnector::connect();
    $result = $conn->query("SELECT 
                                Matches.Date as match_date, 
                                Team1.Name as team1, 
                                Team2.Name as team2, 
                                Matches.Goals_Team1 as goals_team1, 
                                Matches.Goals_Team2 as goals_team2 
                            FROM Matches 
                            JOIN Teams as Team1 ON Matches.Id_Team1 = Team1.Id 
                            JOIN Teams as Team2 ON Matches.Id_Team2 = Team2.Id
                            WHERE Matches.Id = $match_id");

    return $result->fetch_assoc();
}

function getMatchStats($match_id) {
    $conn = DatabaseConnector::connect();
    $result = $conn->query("SELECT 
                                Stats.Id_PlayerMVP as mvp_player_id,
                                Stats.Ball_Control_Team1 as ball_control_team1 
                            FROM Stats 
                            WHERE Stats.Id_Match = $match_id");

    return $result->fetch_assoc();
}

function getMatchGoals($match_id) {
    $conn = DatabaseConnector::connect();
    $result = $conn->query("SELECT 
                                Player.Name as player_name, 
                                Goals.Minute as goal_minute 
                            FROM Goals 
                            JOIN Player ON Goals.Id_Player = Player.Id 
                            WHERE Goals.Id_Stat = (SELECT Id FROM Stats WHERE Id_Match = $match_id)");

    $goals = [];
    while ($row = $result->fetch_assoc()) {
        $goals[] = $row;
    }

    return $goals;
}

function getMatchCards($match_id) {
    $conn = DatabaseConnector::connect();
    $result = $conn->query("SELECT 
                                Player.Name as player_name, 
                                Cartons.Carton as carton_type, 
                                Cartons.Minute as carton_minute
                            FROM Cartons 
                            JOIN Player ON Cartons.Id_Player = Player.Id
                            WHERE Cartons.Id_Stat = (SELECT Id FROM Stats WHERE Id_Match = $match_id)");

    $cards = [];
    while ($row = $result->fetch_assoc()) {
        $cards[] = $row;
    }

    return $cards;
}

function getTeams() {
    $conn = DatabaseConnector::connect();

    $result = $conn->query("
        SELECT 
            Teams.Id AS team_id,
            Teams.Name AS team_name,
            Teams.Country AS country,
            Teams.Formation AS formation,
            Player.Id AS player_id,
            Player.Name AS player_name,
            Player.Position AS position
        FROM 
            Teams
        LEFT JOIN 
            Player ON Player.Id_Team = Teams.Id
    ");

    $teams = [];

    while ($row = $result->fetch_assoc()) {
        $team_id = $row['team_id'];

        if (!isset($teams[$team_id])) {
            $teams[$team_id] = [
                'id' => $team_id,
                'name' => $row['team_name'],
                'country' => $row['country'],
                'formation' => $row['formation'],
                'players' => []
            ];
        }

        if ($row['player_id']) {
            $teams[$team_id]['players'][] = [
                'id' => $row['player_id'],
                'name' => $row['player_name'],
                'position' => $row['position']
            ];
        }
    }

    return array_values($teams);
}


function calculatePosition($wins, $losses, $draws) {
    return ($wins * 3) + ($draws);
}
?>