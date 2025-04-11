<?php
require_once '../Database/DatabaseConnector.php';
require_once '../SessionManager.php';
require_once '../HelperFunctions.php';
require_once '../Model/User.php';

SessionManager::start();
$user = SessionManager::get("user");
if (!$user) {
    redirectTo("../Pages/Login.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($name) && !empty($email)) {
        $user->setName($name);
        $user->setEmail($email);
        
        if (!empty($password)) {
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        $user->updateProfile();
        redirectTo("Profile.php");
    } else {
        $errorMessage = "Name and Email cannot be empty.";
    }
}
?>