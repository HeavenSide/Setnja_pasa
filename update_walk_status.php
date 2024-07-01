<?php
require_once "db_config.php";

// Get the JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (isset($data['id']) && isset($data['action'])) {
    $id = $data['id'];
    $action = $data['action'];

    // Prepare the update query
    if ($action == 1) { // Accept
        $query = "UPDATE dog_walking_appt SET accepted = 1 WHERE id = :id";
    } elseif ($action == 0) { // Refuse
        $query = "UPDATE dog_walking_appt SET accepted = 0 WHERE id = :id";
    } elseif ($action == 2) { // Done
        $query = "UPDATE dog_walking_appt SET done = 1 WHERE id = :id";
    }

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
