<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Walking Messages</title>
    <link rel="stylesheet" href="css/list_messages.css">
</head>
<body>
    <header>
        <h1>Dog Walking Messages</h1>
    </header>
    <div class="container">
        <?php
        require_once "db_config.php";
        include "navigation.php";
        session_start();

        if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'walker' && $_SESSION['role'] != 'admin')) {
            echo "<div class='error'>You are not logged in as a walker or admin!</div>";
            exit();
        }

        try {
            $sql = $dbh->prepare("SELECT * FROM dog_walking_appt WHERE walker = :walker ORDER BY booking_date");
            $sql->bindParam(":walker", $_SESSION['name'], PDO::PARAM_STR);
            $sql->execute();
            $messages = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($messages as $message) {
                echo "<div class='message-card'>";
                if ($message['opened'] == 0) {
                    echo "<b>{$message['owner_name']}</b>";
                } else {
                    echo "{$message['owner_name']}";
                }
                echo " <button type='button' class='open-message' data-id='{$message['walk_id']}'>Open message</button>";
                echo "</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
    <footer>
        <?php include "footer.php"; ?>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.open-message').forEach(function(button) {
            button.addEventListener('click', function() {
                var walkId = this.getAttribute('data-id');
                window.location.href = 'message.php?walk_id=' + walkId;
            });
        });
    });
    </script>
</body>
</html>
