<?php
require_once "db_config.php";

session_start();

if(!isset($_SESSION['name']) && !isset($_SESSION['role'])) {
    echo "You are not logged in";
    exit();
}

$username = $_SESSION['name'];
$user_type = $_SESSION['role'];

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

try {
    if ($user_type == 'walker') {
        $sql = "UPDATE walker SET fname = :fname, lname = :lname, about = :about, phone_number = :phone_number, address = :address, country = :country, city = :city, accept = :accepting WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
    } elseif ($user_type == 'user') {
        $sql = "UPDATE user SET fname = :fname, lname = :lname, phone_number = :phone_number, address = :address, email = :email, country = :country, city = :city WHERE email = :username";
    }

    $query = $dbh->prepare($sql);

    $usernameUpdate = $_POST['pfemail'];
    $username_without_at = str_replace('@gmail.com', '', $usernameUpdate);
    $_SESSION['name'] = $username_without_at;

    $query->bindParam(':fname', $_POST['pfname'], PDO::PARAM_STR);
    $query->bindParam(':lname', $_POST['pflname'], PDO::PARAM_STR);
    $query->bindParam(':phone_number', $_POST['pfphone'], PDO::PARAM_STR);
    $query->bindParam(':address', $_POST['pfaddress'], PDO::PARAM_STR);
    $query->bindParam(':country', $_POST['pfcountry'], PDO::PARAM_STR);
    $query->bindParam(':city', $_POST['pfcity'], PDO::PARAM_STR);
    $query->bindParam(':username', $username_without_at, PDO::PARAM_STR);

    if ($user_type == 'walker') {
        $query->bindParam(':about', $_POST['about'], PDO::PARAM_STR);
        $accepting = isset($_POST['myCheckbox']) ? 1 : 0;
        $query->bindParam(':accepting', $accepting, PDO::PARAM_INT);
    }

    $query->execute();
    echo "<script>alert('Data updated successfully');window.location.href = 'profile.php';</script>";
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
