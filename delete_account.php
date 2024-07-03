<?php
session_start();
require_once "db_config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

try {
    // Initialize SQL based on user role
    $sql = '';
    if ($_SESSION['role'] == 'walker') {
        $sql = $dbh->prepare("DELETE FROM walker WHERE email=:username");
    } elseif ($_SESSION['role'] == 'user') {
        $sql = $dbh->prepare("DELETE FROM user WHERE email=:username");
    } else {
        header("Location: index.php");
        exit();
    }

    // Bind parameters
    $sql->bindParam(':username', $_SESSION['name'], PDO::PARAM_STR);

    // Prepare mail content
    $mailMessage = "Dear " . $_SESSION['name'] . ",<br><br>
    We're writing to confirm that your account on <b>Paws&Pets</b> has been successfully deleted. 
    Whether you were a walker or a regular user, we want to take a moment to say goodbye and thank you for being a part of our community. <br><br>
    We wish you all the best in your future endeavors and hope that you and your furry friends stay happy and healthy.<br><br>
    Warm regards,
    The Paws&Pets Team";

    $mailTitle = "Dog Walking Request Update: Walker Unavailable";
    $mailTo = $_SESSION['name'] . "@gmail.com";

    // Send email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.42.stud.vts.su.ac.rs';
    $mail->SMTPAuth = true;
    $mail->Username = 'four2';
    $mail->Password = '6pxxIS2mnrjtjIz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('four2@42.stud.vts.su.ac.rs', 'Mailer');
    $mail->addAddress($mailTo);
    $mail->isHTML(true);
    $mail->Subject = $mailTitle;
    $mail->Body = $mailMessage;
    $mail->AltBody = strip_tags($mailMessage);

    // Disable SMTP debug
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Commented out

    // Send mail
    $mail->send();

    // Execute SQL query
    $sql->execute();

    header("Location: logout.php");
    exit();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    header("Location: profile.php");
    exit();
}
