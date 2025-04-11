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
            <h2>Retrieve Password</h2>
            <form action="../actions/send_email.php" method="post">
                <input type="email" name="email" placeholder="Email@example.com" required>
                <button type="submit" name="getEmail">Send Email</button>
            </form>
        </div>
    </div>
</body>
<?php
?>
</html>
