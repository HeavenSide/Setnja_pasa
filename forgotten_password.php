<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $userType = $_POST['userType'];
    $reset_token = bin2hex(random_bytes(32)); // Generate a random 32-character token

    try {
        // Update database with activation code based on user type
        $table = $userType == 'walker' ? 'walker' : 'user';
        $sql = "UPDATE $table SET reset_password=:code WHERE email=:username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':code', $reset_token, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        // Prepare email sending
        $mail = new PHPMailer(true);
        $mailTo = $username . "@gmail.com";
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'mail.42.stud.vts.su.ac.rs';
        $mail->SMTPAuth = true;
        $mail->Username = 'four2';
        $mail->Password = '6pxxIS2mnrjtjIz';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('four2@42.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($mailTo);

        $reset_link = 'https://42.stud.vts.su.ac.rs/setnja_pasa/reset_password.php?token=' . $reset_token;

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body = 'Click <a href="' . $reset_link . '">here</a> to reset your password.';
        $mail->AltBody = 'Please visit ' . $reset_link . ' to reset your password.';

        $mail->send();

        echo "<script>alert('Email sent successfully. Check your email for instructions.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Unable to send email.');</script>";
    } finally {
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
}
?>


<form action="forgotten_password.php" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="userType">Who are you?</label>
        <select id="userType" name="userType" required>
            <option value="user">User</option>
            <option value="walker">Walker</option>
        </select>
    </div>
    <button type="submit">Submit</button>
</form>
