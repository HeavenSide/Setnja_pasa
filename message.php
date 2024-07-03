<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Walking Appointments</title>
    <link rel="stylesheet" href="css/message.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Opened Message</h1>
        </header>
        <div class="chatbox">
            <?php
            require_once "db_config.php";
            include "navigation.php";
            session_start();

            if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'walker' && $_SESSION['role'] != 'admin')) {
                echo "<div class='message error'>You are not logged in as a walker!</div>";
                exit();
            }

            if (!isset($_GET['walk_id'])) {
                echo "<div class='message error'>Please select a message to view</div>";
                exit();
            }

            echo "<br><br><br>";

            try {
                $sql = $dbh->prepare("SELECT * FROM dog_walking_appt dwp INNER JOIN user u ON dwp.owner_name = u.email WHERE dwp.walker = :walker AND dwp.walk_id = :walk_id ORDER BY booking_date");
                $sql->bindParam(":walker", $_SESSION['name'], PDO::PARAM_STR);
                $sql->bindParam(":walk_id", $_GET['walk_id'], PDO::PARAM_INT);
                $sql->execute();
                $messages = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach ($messages as $message) {
                    echo "<div class='message'>";
                    echo "Hi! My name is " . $message['email'] . "!<br>And I would like you to take my dog, " . $message['dog_name'] . ", for a walk.<br><br> Here's some more information:<br>";
                    echo "<b>Breed: </b>" . $message['breed'] . "<br><b>Age: </b>" . $message['age'] . "<br><b>Additional requests or specifications: </b>" . $message['additional_info'] . "<br><br>";
                    echo "It would be great if the walk was held on: (YYYY-DD-MM) <b>" . $message['booking_date'] . "</b><br>The start time at: <b>" . $message['start_time'] . "</b><br>";
                    echo "Until at least: <b>" . $message['end_time'] . "</b><br><br>Please head to the Walk Requests tab to accept or refuse this walk";
                    echo "</div><br><hr><br>";
                }

                $read = $dbh->prepare("UPDATE dog_walking_appt SET opened = 1 WHERE walk_id = :walk_id");
                $read->bindParam(":walk_id", $_GET['walk_id'], PDO::PARAM_INT);
                $read->execute();
            } catch (PDOException $e) {
                echo "<div class='message error'>Error: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
