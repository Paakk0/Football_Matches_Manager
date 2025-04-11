<?php
require_once '../database/connector.php';
require_once '../model/user.php';
require_once '../session.php';
require_once '../actions/helper_functions.php';
Session::start();

$conn = DatabaseConnector::connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $registrationDate = date('Y-m-d H:i:s');
        $role = isset($_POST['role']) ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO Users (Name, Email, Password, Registration_Date, Role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $password, $registrationDate, $role);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update_user'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = isset($_POST['role']) ? 1 : 0;

        $stmt = $conn->prepare("UPDATE Users SET Name = ?, Email = ?, Role = ? WHERE Id = ?");
        $stmt->bind_param("ssii", $name, $email, $role, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_user'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM Users WHERE Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    redirect("../pages/manage_users.php");
}

$result = $conn->query("SELECT * FROM Users");
$users = $result->fetch_all(MYSQLI_ASSOC);
?>