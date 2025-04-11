<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Mailer/PHPMailer-master/src/Exception.php';
require 'Mailer/PHPMailer-master/src/PHPMailer.php';
require 'Mailer/PHPMailer-master/src/SMTP.php';
require_once '../database/connector.php';
require_once '../model/user.php';
require_once '../session.php';
include 'helper_functions.php';

$conn = DatabaseConnector::connect();

$sender = "email@example.com";
$password = "password_for_email";

if(isset($_POST['getEmail'])){
    $receiver = $_POST['email'];
    
    $stmt = $conn->prepare("SELECT * FROM Users WHERE Email=?");
    $stmt->bind_param("s",$receiver);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $user = new User($row['Id'], $row['Name'], $row['Email'], $row['Password'], $row['Registration_Date'], $row['Role']);

    $id = $user->getId();
    $userPass = generateRandomPassword();
    $userName = $user->getName();

    
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Debugoutput = 2;
        $mail->Host        = 'smtp.abv.bg';
        $mail->SMTPAuth    = true;
        $mail->Username    = $sender;
        $mail->Password    = $password;
        $mail->SMTPSecure  = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port        = 465;
        $mail->setFrom($sender, 'Forgotten Password');
        $mail->addAddress($user->getEmail());
        $mail->isHTML(false);
        $mail->Subject = "Password Retreiver.";
        $mail->Body    = "Dear $userName,\n We send you this email alongside your temporary new password: $userPass.\nMake sure to change your password after you log back in to our website!";
        $mail->send();

        $userPass = password_hash($userPass,PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE Users SET Password=? WHERE Id=?");
        $stmt->bind_param("si",$userPass,$id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        if ($user->getRole) {
            alertAndRedirect("$mail->ErrorInfo","../pages/login.php","error");
        }
    }
}
alertAndRedirect("An email has been sent to you containing your password!","../pages/login.php","info");

function generateRandomPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    $password = '';
    $charLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, $charLength - 1)];
    }
    
    return $password;
}