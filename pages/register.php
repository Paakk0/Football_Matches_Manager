<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Register</h2>
            <form action="../actions/user_handler.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Email@example.com" required>
                <input type="password" name="password" placeholder="Password" minlength="8" required>
                <button type="submit" name="signUp">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
