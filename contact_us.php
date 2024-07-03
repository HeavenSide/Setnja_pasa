<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header("Content-Type: application/json");
require_once 'db_config.php';
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = isset($data['fname']) ? strip_tags($data['fname']) : 'Jane';
    $lastname = isset($data['Lname']) ? strip_tags($data['Lname']) : 'Doe';
    $email = isset($data['Gmail']) ? strip_tags($data['Gmail']) : 'unknownemail@gmail.com';
    $phone = isset($data['Phone-num']) ? strip_tags($data['Phone-num']) : '';
    $message = strip_tags($data['exampleFormControlTextarea1']);
    $reason = $data['typeOfComplaint'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.42.stud.vts.su.ac.rs'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'four2'; // SMTP username
        $mail->Password = '6pxxIS2mnrjtjIz'; // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('four2@42.stud.vts.su.ac.rs', "".$reason);
        $mail->addAddress('samantajozic@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = $reason;
        $mail->Body = $firstname . ' ' . $lastname . "\nMessage:" . $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
