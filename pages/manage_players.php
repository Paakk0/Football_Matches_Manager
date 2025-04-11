<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Players</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/manage_players.css?v=1.1">
    <script>
        function filterTable() {
            let inputId = document.getElementById("filter_id").value.toLowerCase();
            let inputName = document.getElementById("filter_name").value.toLowerCase();
            let inputTeam = document.getElementById("filter_team").value.toLowerCase();
            let inputPosition = document.getElementById("filter_position").value.toLowerCase();

            let table = document.getElementById("players_table");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cols = rows[i].getElementsByTagName("td");
                if (cols.length > 0) {
                    let id = cols[0].innerText.toLowerCase();
                    let name = cols[1].getElementsByTagName("input")[0].value.toLowerCase();
                    let team = cols[2].getElementsByTagName("select")[0].selectedOptions[0].text.toLowerCase();
                    let position = cols[3].getElementsByTagName("input")[0].value.toLowerCase();

                    if (
                        (id.includes(inputId) || inputId === "") &&
                        (name.includes(inputName) || inputName === "") &&
                        (team.includes(inputTeam) || inputTeam === "") &&
                        (position.includes(inputPosition) || inputPosition === "")
                    ) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</head>
<body>
    <?php
    include 'navbar.php';
    include_once '../actions/admin/handle_player_functions.php';

    $user = Session::get('user');
    if (!$user->getRole()) {
        alertAndRedirect("You are not supposed to be here!", "home.php", "error");
    }
    ?>

    <h1>Manage Players</h1>

    <h2>Add New Player</h2>
    <form method="POST">
        <label for="player_name">Player Name:</label>
        <input type="text" id="player_name" name="player_name" required>

        <label for="team_id">Select Team:</label>
        <select id="team_id" name="team_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['Id']; ?>"><?php echo htmlspecialchars($team['Name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>
        <button type="submit" name="add_player">Add Player</button>
    </form>

    <h2>Players List</h2>

    <div class="filter-container">
        <input type="text" id="filter_id" onkeyup="filterTable()" placeholder="Filter by ID">
        <input type="text" id="filter_name" onkeyup="filterTable()" placeholder="Filter by Name">
        <input type="text" id="filter_team" onkeyup="filterTable()" placeholder="Filter by Team">
        <input type="text" id="filter_position" onkeyup="filterTable()" placeholder="Filter by Position">
    </div>

    <table id="players_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Player Name</th>
                <th>Team</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player): ?>
                <tr>
                    <form method="POST">
                        <td><?php echo $player['Id']; ?></td>
                        <td><input type="text" name="player_name" value="<?php echo htmlspecialchars($player['Name']); ?>" required></td>
                        <td>
                            <select name="team_id">
                                <?php foreach ($teams as $team): ?>
                                    <option value="<?php echo $team['Id']; ?>" 
                                        <?php echo ($team['Id'] == $player['Id_Team']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($team['Name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" name="position" value="<?php echo htmlspecialchars($player['Position']); ?>" required></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $player['Id']; ?>">
                            <button type="submit" name="update_player">Update</button>
                            <button type="submit" name="delete_player">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
