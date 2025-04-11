<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
</head>
<body>
    <?php include 'navbar.php'?>

    <div class="profile-container">
        <h1>User Profile</h1>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($user->getId()); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user->getName()); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user->getEmail()); ?></p>
        <p><strong>Registration Date:</strong> <?php echo htmlspecialchars($user->getRegistrationDate()); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user->getRole() == 1 ? "Admin" : "User"); ?></p>
        <br>
        <a class="edit" href="edit_profile.php">Edit Profile</a>
    </div>
</body>
</html>
