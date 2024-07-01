<?php
require_once "db_config.php";

session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['role'])) {
    echo json_encode(['message' => 'You are not logged in']);
    exit();
}

$username = $_SESSION['name'];
$user_type = $_SESSION['role'];

if ($user_type != 'walker') {
    echo json_encode(['message' => 'Invalid user type']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$isAccepting = isset($data['checked']) && $data['checked'] ? 1 : 0;

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

try {
    $sql = "UPDATE walker SET accept = :accept WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':accept', $isAccepting, PDO::PARAM_INT);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    echo json_encode(['message' => 'Status updated successfully']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
}
