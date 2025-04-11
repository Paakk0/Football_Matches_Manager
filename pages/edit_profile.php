<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/edit_profile.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Edit Profile</h2>
            <form action="../actions/user_handler.php" method="POST">
                <input type="text" name="name" value="<?php echo htmlspecialchars($user->getName()); ?>" placeholder="Full Name" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" placeholder="Email@example.com" required>
                <input type="password" name="old_password" placeholder="Old Password" minlength="8">
                <input type="password" name="new_password" placeholder="New Password" minlength="8">
                <button type="submit" name="updateProfile">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
