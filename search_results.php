<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cards.css">
    <title>Search for a walker</title>
</head>
<body>
<?php
session_start();
require_once "db_config.php";

if (isset($_GET['query'])) {
    $searchingFor = $_GET['query'];

    $stmt_walkers = $dbh->prepare('SELECT * FROM walker WHERE (email = :walkingDude OR fname = :walkingDude OR lname = :walkingDude) AND ppl_rated > 0 AND approved = 1 AND active = 1 ORDER BY rating / ppl_rated DESC');
    $stmt_walkers->bindParam(':walkingDude', $searchingFor, PDO::PARAM_STR);
    $stmt_walkers->execute();
    $walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

    foreach ($walkers as $walker) {
        echo '<div><img src="' . htmlspecialchars($walker['photo'], ENT_QUOTES, 'UTF-8') . '" alt="User Image" style="width:100px"><h3>' . htmlspecialchars($walker['fname'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($walker['lname'], ENT_QUOTES, 'UTF-8') . '</h3><p>' . htmlspecialchars($walker['about'], ENT_QUOTES, 'UTF-8') . '</p><button value="' . htmlspecialchars($walker['walker_id'], ENT_QUOTES, 'UTF-8') . '">Show more</button></div>';
    }
} else {
    echo "<p>No search query provided.</p>";
}
?>
</body>
</html>
