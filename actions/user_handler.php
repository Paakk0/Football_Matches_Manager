<?php

require_once '../model/user.php';
require_once '../database/connector.php';
require_once '../session.php';
include '../actions/helper_functions.php';
$conn = DatabaseConnector::connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signUp'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            alertAndRedirect("User with this email already exists!","../pages/login.php","error");
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $registration_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO users (name, email, password, registration_date) VALUES ('$name', '$email', '$password', '$registration_date')";

        if ($conn->query($sql) === TRUE) {
            Session::start();
            Session::set("user", new User($conn->insert_id, $name, $email, $password, $registration_date, 0));
            redirect("../pages/home.php");
        } 
        else {
            alert("Error: " . $sql . "<br>" . $conn->error);
        }
    } 
    elseif (isset($_POST['signIn'])) {
        $email = $_POST['email'];        
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row['Password'])) {
                Session::start();
                Session::set("user", new User($row['Id'], $row['Name'], $row['Email'], $row['Password'], $row['Registration_Date'], $row['Role']));
                redirect("../pages/home.php");
            } else {
            alertAndRedirect("Incorrect password!","../pages/login.php","error");
            }
        } else {
            alertAndRedirect("No user found with this email!","../pages/login.php","error");
        }
    }
    elseif (isset($_POST['updateProfile'])) {
        Session::start();
        $user = Session::get('user');
        $id = $user->getId();
    
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        $stmt = $conn->prepare("SELECT Password FROM Users WHERE Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        
        if(!empty($password)){
            if (!$user_data || !password_verify($old_password, $user_data['Password'])) {
                alertAndRedirect("Incorrect password!", "../pages/edit_profile.php", "error");
                exit();
            }
        }
        else{
            $password = $user_data['Password'];
        }
    
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $user_data['Password'];
        }
    
        $stmt = $conn->prepare("UPDATE Users SET Name=?, Email=?, Password=? WHERE Id=?");
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $id);
    
        if ($stmt->execute()) {
            Session::destroy();
            alertAndRedirect("Profile updated successfully!", "../pages/login.php", "success");
        } else {
            alertAndRedirect("Error updating profile!", "../pages/edit_profile.php", "error");
        }
    }
    
}

$conn->close();
?>