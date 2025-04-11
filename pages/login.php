<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">    
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Login</h2>
            <form action="../actions/user_handler.php" method="post">
                <input type="email" name="email" placeholder="Email@example.com" required>
                <input type="password" name="password" placeholder="Password" minlength="8" required>
                <button type="submit" name="signIn">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <a href="retreive_password.php">Forgot password?</a>
        </div>
    </div>
</body>
</html>
