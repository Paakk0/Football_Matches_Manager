<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teams</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/manage_teams.css">
</head>
<body>
    <?php
    include 'navbar.php';
    include_once '../actions/admin/handle_team_functions.php';

    $user = Session::get('user');
    if (!$user->getRole()) {
        alertAndRedirect("You are not supposed to be here!", "home.php", "error");
    }
    ?>

    <h1>Manage Teams</h1>

    <h2>Teams List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Team Name</th>
                <th>League</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <form method="POST">
                        <td><?php echo $team['Id']; ?></td>
                        <td><input type="text" name="team_name" value="<?php echo htmlspecialchars($team['Name']); ?>" required></td>
                        <td>
                            <select name="league_id">
                                <?php foreach ($leagues as $league): ?>
                                    <option value="<?php echo $league['Id']; ?>" 
                                        <?php echo ($league['Id'] == $team['Id_League']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($league['Name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" name="formation" value="<?php echo htmlspecialchars($team['Formation']); ?>" required></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $team['Id']; ?>">
                            <button type="submit" name="update_team">Update</button>
                            <button type="submit" name="delete_team">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Add New Team</h2>
    <form method="POST">
        <label for="team_name">Team Name:</label>
        <input type="text" id="team_name" name="team_name" required>

        <label for="league_id">Select League:</label>
        <select id="league_id" name="league_id" required>
            <?php foreach ($leagues as $league): ?>
                <option value="<?php echo $league['Id']; ?>"><?php echo htmlspecialchars($league['Name']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="formation">Formation:</label>
        <input type="text" id="formation" name="formation" required>

        <button type="submit" name="add_team">Add Team</button>
    </form>

</body>
</html>
