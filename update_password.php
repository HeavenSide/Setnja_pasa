<?php
// Ensure sessions are started
session_start();

require_once "db_config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['name'];
    $newPassword = $_POST['newPassword'];

    if (empty($newPassword)) {
        echo "Password cannot be empty.";
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    try {
        if ($_SESSION['role'] == 'walker') {
            $sql = "UPDATE walker SET password = :newPassword WHERE email = :username";
        } elseif ($_SESSION['role'] == 'user') {
            $sql = "UPDATE user SET password = :newPassword WHERE email = :username";
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
