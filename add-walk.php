<?php
session_start(); // Ensure the session is started

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_SESSION['role']=='walker' || $_SESSION['role']=='admin'){


        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $path = isset($_POST['path']) ? $_POST['path'] : '';
        $hours = isset($_POST['hours']) ? $_POST['hours'] : '00';
        $minutes = isset($_POST['minutes']) ? $_POST['minutes'] : '00';
        $walk_id = isset($_POST['walk_id']) ? $_POST['walk_id'] : '00';

        // Validate inputs
        if (empty($walk_id) || (!isset($_POST['description']) && !isset($_POST['userDescription']))) {
            $message = "Invalid input.";
        } else {
            $duration = sprintf('%02d:%02d:00', $hours, $minutes);

            try {
                $sql = $dbh->prepare("
                UPDATE dog_walking_appt 
                SET 
                    walker_view = :description, 
                    path = :path, 
                    duration = :duration
                WHERE 
                    walk_id = :activation_code
            ");

                $sql->bindParam(':description', $description, PDO::PARAM_STR);
                $sql->bindParam(':path', $path, PDO::PARAM_STR);
                $sql->bindParam(':duration', $duration, PDO::PARAM_STR);
                $sql->bindParam(':activation_code', $walk_id, PDO::PARAM_INT);

                if ($sql->execute()) {
                    // Fetch the user's email and walker's rating code
                    $stmt = $dbh->prepare("SELECT dwp.owner_name, w.rating_enable 
                                       FROM dog_walking_appt dwp
                                       JOIN walker w ON dwp.walker = w.email 
                                       WHERE walk_id = :walk_id");
                    $stmt->bindParam(':walk_id', $walk_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result) {
                        $mail = new PHPMailer(true);

                        try {
                            $mailMessage = "Hello,\n\nThank you for using our dog walking service. Please use the following code to rate your walker: " . $result['rating_enable'] . "\n\nBest regards,\nPaws&Pets";
                            $mailTitle = "Rate Your Walker";
                            $mailTo = $result['owner_name']."@gmail.com";

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
                            $mail->Body = nl2br($mailMessage); // Converts newlines to <br> tags for HTML body
                            $mail->AltBody = $mailMessage;

                            $mail->send();
                            $message = "Record updated successfully and email sent!";
                        } catch (Exception $e) {
                            $message = "Record updated but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    } else {
                        $message = "Record updated but failed to fetch user email.";
                    }
                } else {
                    $message = "Error: Unable to execute the SQL query.";
                }
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        }

    } else if($_SESSION['role']=='user'){
        $description = isset($_POST['userDescription']) ? $_POST['userDescription'] : '';
        $walk_id = isset($_POST['walk_id']) ? $_POST['walk_id'] : '00';
        $rating = isset($_POST['rating']) ? $_POST['rating'] : 0;

        // Validate inputs
        if (empty($walk_id) || (!isset($_POST['description']) && !isset($_POST['userDescription']))) {
            $message = "Invalid input.";
        } else {
            try {
                $sql = $dbh->prepare("
                UPDATE dog_walking_appt 
                SET 
                    user_view = :description, 
                    walk_rating = :rating
                WHERE 
                    walk_id = :activation_code
            ");

                $sql->bindParam(':description', $description, PDO::PARAM_STR);
                $sql->bindParam(':rating', $rating, PDO::PARAM_INT);
                $sql->bindParam(':activation_code', $walk_id, PDO::PARAM_INT);

                if ($sql->execute())
                    $_SESSION['allowed']=0;
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        }

        $sql=$dbh->prepare("INSERT INTO walks (walker_view, user_view, path, duration, rating, date, walker, walk_id, email)
        SELECT walker_view, user_view,  path, duration, walk_rating, booking_date, walker, walk_id, owner_name");

        if($sql->execute()){
            $sql=$dbh->prepare("DELETE FROM dog_walking_appt WHERE walk_id=:walk_id");
            $sql->bindParam(':walk_id', $walk_id, PDO::PARAM_INT);
        }

    }

    $dbh = null;
} else {
    $message = "Invalid request.";
}
?>

<script>
    alert("<?php echo $message; ?>");
    window.location.href = 'diary.php';
</script>
