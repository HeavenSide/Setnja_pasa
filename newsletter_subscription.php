<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once 'db_config.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['form5Example2'];

    $mail = new PHPMailer(true);
    $mailMessage = "You have successfully subscribed to our newsletter!";
    $mailTitle = "Newsletter Subscription";
    $mailTo = $username;

    try {

        echo '<p>Mail has been sent</p>';
        $sql = "INSERT INTO newsletter (email) VALUES (:username)";
        $query = $dbh->prepare($sql);

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.42.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'four2';                     //SMTP username
        $mail->Password = '6pxxIS2mnrjtjIz';                               //SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('four2@42.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($mailTo);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mailTitle;
        $mail->Body = $mailMessage;
        $mail->AltBody = $mailMessage;

        $mail->send();
    } finally {
        echo "<script>
                alert('subscription successful');
                window.location.href = 'index.php';
            </script>";
    }
}
