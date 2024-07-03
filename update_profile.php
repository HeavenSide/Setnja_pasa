<?php
session_start();

if (!isset($_SESSION['name'])) {
    echo json_encode(['success' => false, 'message' => 'You are not logged in']);
    exit();
}

require_once "db_config.php";

$role = $_SESSION['role'];
$username = $_SESSION['name'];

$pfname = isset($_POST['pfname']) ? $_POST['pfname'] : '';
$pflname = isset($_POST['pflname']) ? $_POST['pflname'] : '';
$pfphone = isset($_POST['pfphone']) ? $_POST['pfphone'] : '';
$pfaddress = isset($_POST['pfaddress']) ? $_POST['pfaddress'] : '';
$pfcountry = isset($_POST['pfcountry']) ? $_POST['pfcountry'] : '';
$pfcity = isset($_POST['pfcity']) ? $_POST['pfcity'] : '';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$accepting = isset($_POST['myCheckbox']) ? 1 : 0; // Checkbox for acceptance, if checked it will be 1, else 0


$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if ($role == 'walker' || $role == 'admin') {
        $sql = "UPDATE walker SET fname = :pfname, lname = :pflname, phone_number = :pfphone, address = :pfaddress, country = :pfcountry, city = :pfcity, about = :about, accept = :accepting WHERE email = :username";
    } else if ($role == 'user') {
        $sql = "UPDATE user SET fname = :pfname, lname = :pflname, phone_number = :pfphone, address = :pfaddress, country = :pfcountry, city = :pfcity WHERE email = :username";
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid user type']);
        exit();
    }

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':pfname', $pfname, PDO::PARAM_STR);
    $stmt->bindParam(':pflname', $pflname, PDO::PARAM_STR);
    $stmt->bindParam(':pfphone', $pfphone, PDO::PARAM_INT);
    $stmt->bindParam(':pfaddress', $pfaddress, PDO::PARAM_STR);
    $stmt->bindParam(':pfcountry', $pfcountry, PDO::PARAM_STR);
    $stmt->bindParam(':pfcity', $pfcity, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if ($role == 'walker' || $role == 'admin') {
        $stmt->bindParam(':about', $about, PDO::PARAM_STR);
        $stmt->bindParam(':accepting', $accepting, PDO::PARAM_BOOL);
    }

    $stmt->execute();
    echo json_encode(['success' => true]);
    header("Location: profile.php");
    exit();
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
