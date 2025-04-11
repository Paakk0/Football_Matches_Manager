<?php
include 'navbar.php';
include_once '../actions/admin/handle_user_functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/manage_users.css?v=1.2">
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>

        <div class="form-container">
            <h2>Add New User</h2>
            <form method="POST" class="user-form">
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="role">Role:</label>
                    <select name="Role">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit" name="add_user" class="btn add">Add User</button>
            </form>
        </div>

        <h2>Update or Delete Users</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <form method="POST">
                            <td><?php echo $user['Id']; ?></td>
                            <td><input type="text" name="name" value="<?php echo $user['Name']; ?>" required></td>
                            <td><input type="email" name="email" value="<?php echo $user['Email']; ?>" required></td>
                            <td>
                                <select name="Role">
                                    <option value="0" <?php echo $user['Role'] == 0 ? 'selected' : ''; ?>>User</option>
                                    <option value="1" <?php echo $user['Role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $user['Id']; ?>">
                                <button type="submit" name="update_user" class="btn update">Update</button>
                                <button type="submit" name="delete_user" class="btn delete">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
