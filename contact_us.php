<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once 'db_config.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $firstname = strip_tags($_POST['fname']);
    $lastname = strip_tags($_POST['Lname']);
    $email = strip_tags($_POST['Gmail']);
    $phone = strip_tags($_POST['Phone-num']);
    $message = strip_tags($_POST['exampleFormControlTextarea1']);
    $reason = $_POST['type'];

    $mail = new PHPMailer(true);
    $mailMessage = $firstname." ".$lastname." \n".$message;
    $mailTitle = $reason;
    $mailTo = 'samantajozic@gmail.com';

    try
    {

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.42.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'four2';                     //SMTP username
        $mail->Password = '6pxxIS2mnrjtjIz';                               //SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('four2@42.stud.vts.su.ac.rs', $firstname." ".$lastname);
        $mail->addAddress($mailTo);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mailTitle;
        $mail->Body = $mailMessage;
        $mail->AltBody = $mailMessage;

        $mail->send();
        exit();
    }
    finally
    {
        header('Location: contact.php');
    }
}

