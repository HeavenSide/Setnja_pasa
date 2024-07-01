<?php
require_once "db_config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $walker_id = $_POST['walker_id'];
    $active = $_POST['active'];

    $stmt = $dbh->prepare('UPDATE walker SET approved = :active WHERE walker_id = :walker_id');
    $stmt->bindParam(':active', $active);
    $stmt->bindParam(':walker_id', $walker_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
