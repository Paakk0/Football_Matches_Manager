<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Matches</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/schedule_matches.css?v=1.0">
    <script>
        function filterTable() {
            let inputId = document.getElementById("filter_id").value.toLowerCase();
            let inputTeam1 = document.getElementById("filter_team1").value.toLowerCase();
            let inputTeam2 = document.getElementById("filter_team2").value.toLowerCase();
            let inputDate = document.getElementById("filter_date").value;
            let dateOption = document.getElementById("date_filter_option").value;

            let pastTable = document.getElementById("past_matches_table");
            let futureTable = document.getElementById("future_matches_table");
            let pastRows = pastTable.getElementsByTagName("tr");
            let futureRows = futureTable.getElementsByTagName("tr");

            filterRows(pastRows);
            filterRows(futureRows);

            function filterRows(rows) {
                for (let i = 1; i < rows.length; i++) {
                    let cols = rows[i].getElementsByTagName("td");
                    if (cols.length > 0) {
                        let id = cols[0].innerText.toLowerCase();
                        let team1 = cols[1].getElementsByTagName("select")[0].selectedOptions[0].text.toLowerCase();
                        let team2 = cols[2].getElementsByTagName("select")[0].selectedOptions[0].text.toLowerCase();
                        let date = cols[3].getElementsByTagName("input")[0].value.toLowerCase();
                    
                        let matchDate = new Date(date);
                        let filterDate = new Date(inputDate);
                    
                        let dateMatch = false;
                        if (dateOption === "before") {
                            dateMatch = matchDate < filterDate;
                        } else if (dateOption === "after") {
                            dateMatch = matchDate > filterDate;
                        }
                    
                        if (
                            (id.includes(inputId) || inputId === "") &&
                            (team1.includes(inputTeam1) || inputTeam1 === "") &&
                            (team2.includes(inputTeam2) || inputTeam2 === "") &&
                            (inputDate === "" || dateMatch)
                        ) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
    <?php
    include 'navbar.php';
    include_once '../actions/admin/handle_match_functions.php';

    $user = Session::get('user');
    if (!$user->getRole()) {
        alertAndRedirect("You are not supposed to be here!", "home.php", "error");
    }
    ?>

    <h1>Schedule Matches</h1>

    <div class="filter-container">
        <input type="text" id="filter_id" onkeyup="filterTable()" placeholder="Filter by ID">
        <input type="text" id="filter_team1" onkeyup="filterTable()" placeholder="Filter by Team 1">
        <input type="text" id="filter_team2" onkeyup="filterTable()" placeholder="Filter by Team 2">
        
        <label for="filter_date">Filter by Date:</label>
        <select id="date_filter_option" onchange="filterTable()">
            <option value="before">Before</option>
            <option value="after">After</option>
        </select>
        <input type="date" id="filter_date" onchange="filterTable()" placeholder="Filter by Date">

    </div>

    <h2>Past Matches</h2>
<table id="past_matches_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Team 1</th>
            <th>Team 2</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($past_matches as $match): ?>
            <tr>
                <form method="POST">
                    <td><?php echo $match['Id']; ?></td>
                    <td>
                        <select name="team1_id">
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['Id']; ?>" 
                                    <?php echo ($team['Id'] == $match['Id_Team1']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($team['Name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="team2_id">
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['Id']; ?>" 
                                    <?php echo ($team['Id'] == $match['Id_Team2']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($team['Name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="datetime-local" name="match_date" value="<?php echo $match['Date']; ?>" required></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $match['Id']; ?>">
                        <a class="add_stats" href="add_match_statistics.php?match_id=<?php echo $match['Id'] ?>">Add Stats</a>
                        <button type="submit" name="update_match">Update</button>
                        <button type="submit" name="delete_match">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Future Matches</h2>
<table id="future_matches_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Team 1</th>
            <th>Team 2</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($future_matches as $match): ?>
            <tr>
                <form method="POST">
                    <td><?php echo $match['Id']; ?></td>
                    <td>
                        <select name="team1_id">
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['Id']; ?>" 
                                    <?php echo ($team['Id'] == $match['Id_Team1']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($team['Name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="team2_id">
                            <?php foreach ($teams as $team): ?>
                                <option value="<?php echo $team['Id']; ?>" 
                                    <?php echo ($team['Id'] == $match['Id_Team2']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($team['Name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="datetime-local" name="match_date" value="<?php echo $match['Date']; ?>" required></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $match['Id']; ?>">
                        <button type="submit" name="update_match">Update</button>
                        <button type="submit" name="delete_match">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <h2>Schedule New Match</h2>
    <form method="POST">
        <label for="team1_id">Select Team 1:</label>
        <select id="team1_id" name="team1_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['Id']; ?>"><?php echo htmlspecialchars($team['Name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="team2_id">Select Team 2:</label>
        <select id="team2_id" name="team2_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['Id']; ?>"><?php echo htmlspecialchars($team['Name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="match_date">Match Date:</label>
        <input type="datetime-local" id="match_date" name="match_date" required>

        <button type="submit" name="add_match">Schedule Match</button>
    </form>

</body>
</html>
