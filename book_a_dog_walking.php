<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'db_config.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_SESSION['name'];
    $dogName = filter_var($_POST['dogName'], FILTER_SANITIZE_STRING);
    $dogBreed = filter_var($_POST['dogBreed'], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST['dogAge'], FILTER_SANITIZE_NUMBER_INT);
    $booking_date = $_POST['bookingDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $walkerName = $_POST['dogWalker'];
    $comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);

    try {
        $sql = "INSERT INTO dog_walking_appt (walker, owner_name, dog_name, breed, age, additional_info, booking_date, start_time, end_time, replied, opened) 
                VALUES (:walker, :owner_name, :dog_name, :breed, :age, :info, :booking_date, :start_time, :end_time, 0, 0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':walker', $walkerName, PDO::PARAM_STR);
        $query->bindParam(':owner_name', $username, PDO::PARAM_STR);
        $query->bindParam(':dog_name', $dogName, PDO::PARAM_STR);
        $query->bindParam(':breed', $dogBreed, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_INT);
        $query->bindParam(':info', $comments, PDO::PARAM_STR);
        $query->bindParam(':booking_date', $booking_date, PDO::PARAM_STR);
        $query->bindParam(':start_time', $startTime, PDO::PARAM_STR);
        $query->bindParam(':end_time', $endTime, PDO::PARAM_STR);
        $query->execute();

        $mail = new PHPMailer(true);
        $mailMessage = "You have booked a dog walking of $dogName, on $booking_date starting at $startTime and ending at $endTime.<br><br>The information you have saved about your dog will be sent to the walker. If you have any special requests you'd like to discuss with the walker, please contact them directly through our website or on their phone which is provided on their profile.<br><br><b>Hope your little one has a great time! <br><i>Paws&Pets</i></b>";
        $mailTitle = "Dog Walking appointment";
        $mailTo = $username . "@gmail.com"; // You might want to use a proper email validation and retrieval

        //Server settings
        $mail->SMTPDebug = 0;                      //Disable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.42.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'four2';                     //SMTP username
        $mail->Password = '6pxxIS2mnrjtjIz';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable TLS encryption
        $mail->Port = 587;                                            //TCP port to connect to

        $mail->setFrom('four2@42.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($mailTo);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mailTitle;
        $mail->Body = $mailMessage;
        $mail->AltBody = strip_tags($mailMessage);

        $mail->send();
        echo "<script>
                alert('An email has been sent to you about the data, please check if everything is correct');
                window.location.href = 'booking.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occurred while saving your booking: " . $e->getMessage() . "'); window.location.href = 'booking.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('An error occurred while sending the email: " . $e->getMessage() . "'); window.location.href = 'booking.php';</script>";
    }
}
?>
