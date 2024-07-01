<?php
session_start();
require_once "db_config.php";

if (!isset($_GET['walker_id'])) {
    echo "Invalid request";
    exit;
}

$walkerId = $_GET['walker_id'];

// Query to get walker details from database
$stmt = $dbh->prepare('SELECT * FROM walker WHERE walker_id = :walkerId');
$stmt->bindParam(':walkerId', $walkerId, PDO::PARAM_INT);
$stmt->execute();
$walker = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$walker) {
    echo "Walker not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css"> <!-- Adjust path to your CSS file -->
    <title><?php echo htmlspecialchars($walker['fname'].' '.$walker['lname']); ?> - Walker Profile</title>
</head>
<body>
    <div class="profile-container">
        <h1><?php echo htmlspecialchars($walker['fname'].' '.$walker['lname']); ?></h1>
        <img src="<?php echo htmlspecialchars($walker['photo']); ?>" alt="Walker Photo" class="profile-photo">
        <p><?php echo htmlspecialchars($walker['about']); ?></p>

        <!-- Add more details as needed -->

        <form action="book_walk.php" method="post"> <!-- Adjust action to your booking handler -->
            <!-- Form fields for booking -->
            <input type="hidden" name="walker_id" value="<?php echo $walkerId; ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <br>
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>
            <br>
            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>
            <br>
            <button type="submit">Book Walk</button>
        </form>
    </div>

    <!-- JavaScript for modal display (if needed) -->
    <div id="bookingConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="bookingConfirmationContent"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle form submission for booking
            var bookingForm = document.querySelector('form[action="book_walk.php"]');
            if (bookingForm) {
                bookingForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    var formData = new FormData(bookingForm);
                    
                    fetch(bookingForm.getAttribute('action'), {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('bookingConfirmationContent').innerHTML = data;
                        document.getElementById('bookingConfirmationModal').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error booking walk');
                    });
                });
            }

            // Close modal when close button is clicked
            document.getElementsByClassName('close')[0].addEventListener('click', function() {
                document.getElementById('bookingConfirmationModal').style.display = 'none';
            });

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target == document.getElementById('bookingConfirmationModal')) {
                    document.getElementById('bookingConfirmationModal').style.display = 'none';
                }
            };
        });
    </script>

</body>
</html>
