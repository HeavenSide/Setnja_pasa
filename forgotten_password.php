<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $userType = filter_input(INPUT_POST, 'userType', FILTER_SANITIZE_STRING);
    $reset_token = bin2hex(random_bytes(32)); // Generate a random 32-character token

    try {
        $table = $userType === 'walker' ? 'walker' : 'user';
        $sql = "UPDATE $table SET reset_password=:code WHERE email=:username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':code', $reset_token, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        // Prepare email sending
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'mail.42.stud.vts.su.ac.rs';
        $mail->SMTPAuth = true;
        $mail->Username = 'four2';
        $mail->Password = '6pxxIS2mnrjtjIz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('four2@42.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($username."@gmail.com");

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-submit {
            border-radius: 0;
            border: 2px solid black;
        }
    </style>
</head>
<body>
<?php include "navigation.php"; 
if(isset($_GET['passwd']) && $_GET['passwd'] == 1){
    echo "<br><br><br>New password cannot be the same as the old password!<br>Token expired, if you still wish to reset your password, you'll need to make the request one more time";
}?>
<div class="container">
    <form action="forgotten_password.php" method="post">
        <div class="form-group">
            <label for="username"><b>Username:</b></label>
            <input type="text" class="form-control" style="background-color: #d3d3d3;":id="username" name="username" placeholder="Enter your Username" required>
        </div>
        <div class="form-group">
            <label for="userType"><b>Who are you?</b></label>
           <select class="form-control" id="userType" style="background-color: #d3d3d3;" name="userType" required>
                <option value="user">User</option>
                <option value="walker">Walker</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-submit">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
