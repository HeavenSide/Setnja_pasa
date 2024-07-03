<?php
require_once "db_config.php";
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Get the JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (isset($data['id']) && isset($data['action'])) {
    $id = $data['id'];
    $action = $data['action'];

    $details=$dbh->prepare("SELECT * FROM dog_walking_appt dwp INNER JOIN walker w ON dwp.walker=w.email WHERE walk_id = :id");
    $details->bindParam(':id', $id, PDO::PARAM_INT);
    $details->execute();

    // Prepare the update query
    if ($action == 1) { // Accept
        $query = "UPDATE dog_walking_appt SET accepted = 1 WHERE walk_id = :id";
    } elseif ($action == 0) { // Refuse
        $query = "UPDATE dog_walking_appt SET accepted = 0, replied=1 WHERE walk_id = :id";
    } elseif ($action == 2) { // Done
        $query = "UPDATE dog_walking_appt SET done = 1 WHERE walk_id = :id";
    }

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        if ($action == 1) { // Accept
            $detailsStmt = $dbh->prepare("SELECT * FROM dog_walking_appt dwp INNER JOIN user u ON dwp.owner_name = u.email WHERE walk_id = :id");
            $detailsStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $detailsStmt->execute();
            $details = $detailsStmt->fetch(PDO::FETCH_ASSOC);


            $mail = new PHPMailer(true);
            $mailMessage = "Dear " . $details['owner_name']
                . ",<br><br>We are thrilled to inform you that your recent dog walking request has been accepted by one of our trusted dog walkers.<br><br><strong>
Details of Your Booking:</strong><br>
Dog Walker: " . $details['walker'] . "<br>
Date: " . $details['booking_date'] . "<br>
Time: " . $details['start_time'] . " - " . $details['end_time'] . "<br>
Our dog walker, " . $details['walker'] . ", is excited to meet your furry friend and provide them with the exercise and care they deserve.
Should you have any special instructions or additional information to share, please feel free to reach out to us or directly to " . $details['walker'] . ".<br><br>
<strong>Contact Information:</strong><br>Dog Walker's Phone Number: " . $details['phone_number'] . "<br>
Dog Walker's Email: " . $details['walker'] . "@gmail.com<br>
Thank you for choosing our services. We are dedicated to ensuring your dog has a great experience. If you have any questions or concerns,
please do not hesitate to contact our support team.<br><br>We look forward to serving you and your pet.<br><br>Best regards,<br><strong>Paws&Pets!</strong>";

            $mailTitle = "Your Dog Walking Request Has Been Accepted!";
            $mailTo = $details['owner_name'] . "@gmail.com";

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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

            $mail->send();
        } elseif ($action == 0) { // Refuse
            $detailsStmt = $dbh->prepare("SELECT * FROM dog_walking_appt dwp INNER JOIN user u ON dwp.owner_name = u.email WHERE walk_id = :id");
            $detailsStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $detailsStmt->execute();
            $details = $detailsStmt->fetch(PDO::FETCH_ASSOC);

            $mail = new PHPMailer(true);
            $mailMessage = "Dear " . $details['owner_name']
                . ",<br><br>We regret to inform you that the dog walker you have chosen is unable to fulfill your recent dog walking request.<br><br>
Unfortunately, " . $details['walker'] . " is unavailable at the requested time.<br><br>
<strong>Contact Information:</strong><br>
Dog Walker's Phone Number: " . $details['phone_number'] . "<br>
Dog Walker's Email: " . $details['walker'] . "@gmail.com<br><br>
We apologize for any inconvenience this may cause. Please visit our <a href='https://42.stud.vts.su.ac.rs/setnja_pasa/walkers.php'>website</a> to choose another available walker or to reschedule your appointment.<br><br>
Thank you for choosing our services. If you have any questions or concerns, please do not hesitate to contact our support team.<br><br>
We look forward to serving you and your pet.<br><br>
Best regards,<br>
<strong>Paws&Pets!</strong>";

            $mailTitle = "Dog Walking Request Update: Walker Unavailable";
            $mailTo = $details['owner_name'] . "@gmail.com";

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
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

            $mail->send();

            $detailsStmt = $dbh->prepare("DELETE FROM dog_walking_appt WHERE walk_id = :id");
            $detailsStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $detailsStmt->execute();
            header("Location: accept_a_walk.php");
            exit();

        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}

