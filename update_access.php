<?php
require_once "db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $active = $_POST['active'];

    $stmt = $dbh->prepare('UPDATE user SET admin_approved = :active WHERE user_id = :user_id');
    $stmt->bindParam(':active', $active);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
