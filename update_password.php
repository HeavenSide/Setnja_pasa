<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if (!isset($_SESSION['name'])) {
    echo json_encode(['success' => false, 'message' => 'You are not logged in']);
    exit();
}

require_once "db_config.php";

$username = $_SESSION['name'];
$newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';

if (empty($newPassword)) {
    echo json_encode(['success' => false, 'message' => 'Password cannot be empty']);
    exit();
}

$newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

try {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch current hashed password to prevent setting the same password
    if ($_SESSION['role'] == 'walker' || $_SESSION['role'] == 'admin') {
        $sql = "SELECT password FROM walker WHERE email = :username";
    } else {
        $sql = "SELECT password FROM user WHERE email = :username";
    }
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($newPassword, $result['password'])) {
        header("Location: profile.php?err=1");
        exit();
    }

    // Update password
    if ($_SESSION['role'] == 'walker' || $_SESSION['role'] == 'admin') {
        $sql = "UPDATE walker SET password = :password WHERE email = :username";
    } else {
        $sql = "UPDATE user SET password = :password WHERE email = :username";
    }
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':password', $newPasswordHash, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: profile.php?succ=1");
        exit();
    }
} catch (PDOException $e) {
    header("Location: profile.php?succ=2");
    exit();
}
?>
