<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require_once 'db_config.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = strip_tags($_POST['firstName']);
    $lastname = strip_tags($_POST['lastName']);
    $username = strip_tags($_POST['email']);
    $phone = strip_tags($_POST['phone']);
    $address = strip_tags($_POST['address']);
    $city = strip_tags($_POST['city']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $country = isset($_POST['country']) ? strip_tags($_POST['country']) : "America";
    $user_type = $_POST['userType'];
    $username_without_at = '';

    if (strpos($username, '@gmail.com') !== false)
    {
        $username_without_at = str_replace('@gmail.com', '', $username);
    }
    else
    {
        die("Please enter a valid e-mail address");
    }

    $five_digit_code = rand(0, 99999);
    $activation_code = str_pad($five_digit_code, 5, '0', STR_PAD_LEFT);

    $file_name = '';
    $file_temp = '';
    $file_type = '';

    if ($user_type == 'premium') {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $file_name = $_FILES['image']["name"];
            $file_temp = $_FILES["image"]["tmp_name"];
            $file_type = $_FILES["image"]["type"];

            if (exif_imagetype($file_temp) != IMAGETYPE_JPEG) {
                die("The file type is not a JPEG");
            }

            $new_file_name = $username_without_at . ".jpg";
            $upload = "imgs/walkers/$new_file_name";

            if ($_FILES['image']["error"] > 0) {
                die("Something went wrong during file upload!");
            } else {
                move_uploaded_file($file_temp, $upload);

                $sql = "INSERT INTO walker (email, password, fname, lname, phone_number, address, city, country, photo, rating_enable, activation_code) VALUES (:username, :hashed_password, :firstname, :lastname, :phone, :address, :city, :country, :photo_path, :rating_enable, :activation_code)";
                if (!empty($dbh)) {
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':username', $username_without_at, PDO::PARAM_STR);
                    $query->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                    $query->bindParam(':phone', $phone, PDO::PARAM_INT);
                    $query->bindParam(':address', $address, PDO::PARAM_STR);
                    $query->bindParam(':city', $city, PDO::PARAM_STR);
                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                    $query->bindParam(':photo_path', $upload, PDO::PARAM_STR);
                    $query->bindParam(':rating_enable', $activation_code, PDO::PARAM_INT);
                    $query->bindParam(':activation_code', $activation_code, PDO::PARAM_INT);

                    if ($query->execute())
                    {
                        $mail = new PHPMailer(true);
                        $mailMessage = "Your activation code is: $activation_code <br> DO NOT REPLY TO THIS EMAIL";
                        $mailTitle = "Activation Code";
                        $mailTo = $username;

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

                        $mail->isHTML(true);
                        $mail->Subject = $mailTitle;
                        $mail->Body = $mailMessage;
                        $mail->AltBody = $mailMessage;

                        $mail->send();
                        echo "<script>alert('Sign up successful! Wait for an admin  to approve, and insert a code during your first login. The code has been sent to your email');window.location.href = 'index.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Sign in failed. Try again  later');window.location.href = 'index.php';</script>";
                    }
                }
            }
        }
    } elseif ($user_type == 'regular') {

        try {
            $sql = 'INSERT INTO user (email, password, fname, lname, phone_number, address, city, country, activation_code) VALUES (:username, :hashed_password, :firstname, :lastname, :phone, :address, :city, :country, :activation_code)';
            $query = $dbh->prepare($sql);
            $query->bindParam(':username', $username_without_at, PDO::PARAM_STR);
            $query->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
            $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':city', $city, PDO::PARAM_STR);
            $query->bindParam(':country', $country, PDO::PARAM_STR);
            $query->bindParam(':activation_code', $activation_code, PDO::PARAM_STR);

            if ($query->execute()) {
                echo 'Sign Up successful! But wait for the admin to approve...<br>';
            } else {
                echo "There has been an error with registering a user!";
            }

            $mail = new PHPMailer(true);
            $mailMessage = "Your activation code is: $activation_code <br> DO NOT REPLY TO THIS EMAIL";
            $mailTitle = "Activation Code";
            $mailTo = $username;

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

            $mail->isHTML(true);
            $mail->Subject = $mailTitle;
            $mail->Body = $mailMessage;
            $mail->AltBody = $mailMessage;

            $mail->send();
            echo "<script>alert('Sign in successful');window.location.href = 'index.php';</script>";
            exit();
        } catch (Exception $e) {
            echo "<script>alert('Unable to send email');window.location.href = 'index.php';</script>";
        }
        finally{
            echo "<script>alert('Sign in successful');window.location.href = 'index.php';</script>";
            exit();
        }
    }
}