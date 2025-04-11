<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leagues</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/manage_leagues.css?v=1.0">
</head>
<body>
    <?php
    include 'navbar.php';
    include_once '../actions/admin/handle_league_functions.php';

    $user = Session::get('user');
    if(!$user->getRole()){
        alertAndRedirect("You are not supposed to be here!","home.php","error");
    }
    ?>

    <h1>Manage Leagues</h1>

    <h2>Leagues</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>League Name</th>
                <th>Teams</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leagues as $league): ?>
                <tr>
                    <form method="POST">
                        <td><?php echo $league['Id']; ?></td>
                        <td><input type="text" name="league_name" value="<?php echo $league['Name']; ?>" required></td>
                        <td><?php echo $league['Team_Count']; ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $league['Id']; ?>">
                            <button type="submit" name="update_league">Update</button>
                            <button type="submit" name="delete_league">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br>

    <h2>Add New League</h2>
    <form method="POST">
        <label for="league_name">League Name:</label>
        <input type="text" id="league_name" name="league_name" required>
        <button type="submit" name="add_league">Add League</button>
    </form><br>

    <h2>Add Team to a League</h2>
    <form method="POST">
        <label for="team_id">Select Team:</label>
        <select id="team_id" name="team_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team[0]; ?>"><?php echo $team[1]; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="league_id">Select League:</label>
        <select id="league_id" name="league_id" required>
            <?php foreach ($leagues as $league): ?>
                <option value="<?php echo $league['Id']; ?>"><?php echo $league['Name']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="add_team_to_league">Assign Team</button>
    </form>

</body>
</html>
