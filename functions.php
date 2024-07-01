<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once 'db_config.php';

function LoginFailure($username, $password, $dbh): void {
    $sql = "INSERT INTO login_failure (username, password, date_time) VALUES (:username, :password, :currentTime)";

    $query = $dbh->prepare($sql);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $currentTime = date('Y-m-d H:i:s');

    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $query->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);

    $query->execute();
}