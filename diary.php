<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walker's Diary</title>
    <link rel="stylesheet" href="css/diary.css">
</head>
<body>
<?php
session_start();
include "navigation.php";
echo "<br><br>";

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] == 'user' && $_SESSION['allowed'] == 0) {
    header("Location: rate_walker.php");
    exit();
}

?>
<div class="container">
    <h1>Walker's Diary</h1>

    <!-- Form to log a new walk -->
    <form id="walkForm" action="add-walk.php" method="post">
        <?php if ($_SESSION['role'] == 'walker' || $_SESSION['role'] == 'admin'): ?>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea>

            <label for="path">Path:</label>
            <textarea id="path" name="path" rows="2" cols="50"></textarea>

            <label for="hours">Duration (HH:MM):</label>
            <div style="display: flex; gap: 5px;">
                <select id="hours" name="hours" required>
                    <?php for ($i = 0; $i < 24; $i++) {
                        $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                        echo "<option value='$hour'>$hour</option>";
                    } ?>
                </select> :
                <select id="minutes" name="minutes" required>
                    <?php for ($i = 0; $i < 60; $i++) {
                        $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                        echo "<option value='$minute'>$minute</option>";
                    } ?>
                </select>
            </div>

            <label for="walk_id">Client:</label>
            <select id="walk_id" name="walk_id" required>
                <?php
                require_once 'db_config.php';
                $stmt = $dbh->prepare("SELECT walk_id, owner_name FROM dog_walking_appt WHERE walker = :walker AND accepted = 1 AND done = 1");
                $stmt->bindParam(':walker', $_SESSION['name'], PDO::PARAM_STR);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user) {
                    echo "<option value='" . htmlspecialchars($user['walk_id']) . "'>" . htmlspecialchars($user['owner_name']) . "</option>";
                }
                ?>
            </select>
        <?php else: ?>
            <label for="userDescription">Impressions:</label>
            <textarea id="userDescription" name="userDescription" rows="4" cols="50" required></textarea>

            <label for="walk_id">Walker:</label>
            <select id="walk_id" name="walk_id" required>
                <?php
                require_once 'db_config.php';
                $stmt = $dbh->prepare("SELECT dwp.walk_id, dwp.walker, w.rating_enable FROM dog_walking_appt dwp INNER JOIN walker w ON dwp.walker=w.email WHERE dwp.owner_name = :user AND w.rating_enable = :code");
                $stmt->bindParam(':user', $_SESSION['name'], PDO::PARAM_STR);
                $stmt->bindParam(':code',   $_SESSION['rating_walker'],PDO::PARAM_INT);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user) {
                    echo "<option value='" . htmlspecialchars($user['walk_id']) . "'>" . htmlspecialchars($user['walker']) . "</option>";
                }
                ?>
            </select>

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
        <?php endif; ?>

        <input type="submit" value="Add Walk">
    </form>

    <!-- Popup for displaying messages -->
    <div id="popup" class="popup">
        <p id="popupMessage"></p>
        <button id="popupButton" onclick="closePopup()">OK</button>
    </div>
    <?php if ($_SESSION['role'] == 'walker' || $_SESSION['role'] == 'admin'): ?>
        <h2>To be rated</h2>
        <?php
        // Displaying the walks log
        $stmt = $dbh->prepare("SELECT * FROM dog_walking_appt WHERE walker = :walker ORDER BY booking_date DESC");
        $stmt->bindParam(':walker', $_SESSION['name'], PDO::PARAM_STR);
        $stmt->execute();
        $walks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($walks) > 0) {
            echo "<table>";
            echo "<tr><th>Description</th><th>Path</th><th>Duration</th><th>Owner</th></tr>";
            foreach ($walks as $walk) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($walk["walker_view"]) . "</td>";
                echo "<td>" . htmlspecialchars($walk["path"]) . "</td>";
                echo "<td>" . htmlspecialchars($walk["duration"]) . "</td>";
                echo "<td>" . htmlspecialchars($walk["owner_name"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No walks recorded yet.";
        }

        $dbh = null;
    endif;
    ?>
</div>

<!-- JavaScript for handling the popup -->
<script>
    function showPopup(message) {
        var popup = document.getElementById('popup');
        var popupMessage = document.getElementById('popupMessage');
        popupMessage.textContent = message;
        popup.style.display = 'block';
    }

    function closePopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    var form = document.getElementById('walkForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                showPopup('Walk successfully added!');
                form.reset();
            } else {
                alert('Error: ' + xhr.statusText);
            }
        };
        xhr.onerror = function() {
            alert('Request failed');
        };
        xhr.send(formData);
    });
</script>

<?php include "footer.php"; ?>

</body>
</html>
