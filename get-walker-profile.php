<?php
// get_walker_profile.php

require_once "db_config.php";

if (!isset($_GET['id'])) {
    exit("Walker ID not provided");
}

$walker_id = $_GET['id'];

// Query to fetch walker profile from database
$stmt = $dbh->prepare("SELECT * FROM walker WHERE walker_id = :walker_id");
$stmt->bindParam(':walker_id', $walker_id, PDO::PARAM_INT);
$stmt->execute();
$walker = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$walker) {
    exit("Walker not found");
}

// Example HTML content for walker profile
echo '<div>';
echo '<h2>' . htmlspecialchars($walker['fname']) . ' ' . htmlspecialchars($walker['lname']) . '</h2>';
echo '<p>Email: ' . htmlspecialchars($walker['email']) . '</p>';
echo '<p>About: ' . htmlspecialchars($walker['about']) . '</p>';
// Add more profile details as needed
echo '</div>';
?>
