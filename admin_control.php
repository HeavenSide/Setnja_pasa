<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin's Control</title>
    <style>
        table, th, td {
            border: 1px solid #1F8642;
            border-collapse: collapse;
            padding: 10px;
            text-align: left;
        }
        table {
            margin: 20px auto; /* Center the table horizontally */
            width: 80%; /* Optional: set the table width to a percentage */
        }
        th {
            background-color: #1F8642;
            color: white;
        }
        .access-denied {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            border: 1px solid #ff0000;
            padding: 10px;
            margin: 20px;
            color: #ff0000;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateActivity(walkerId, newActive) {
            $.ajax({
                url: 'update_activity.php',
                type: 'POST',
                data: {
                    walker_id: walkerId,
                    active: newActive
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert('Active status updated successfully');
                        location.reload(); // Reload the page to see changes
                    } else {
                        alert('Failed to change active status');
                    }
                },
                error: function() {
                    alert('Error updating active status');
                }
            });
        }

        function handleButtonClick(button, newActive) {
            var walkerId = $(button).val();
            updateActivity(walkerId, newActive);
        }

        function updateAccess(userId, newActive) {
            $.ajax({
                url: 'update_access.php',
                type: 'POST',
                data: {
                    user_id: userId,
                    active: newActive
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert('Active status updated successfully');
                        location.reload(); // Reload the page to see changes
                    } else {
                        alert('Failed to change active status');
                    }
                },
                error: function() {
                    alert('Error updating active status');
                }
            });
        }

        function handleButtonClickUser(button, newActive) {
            var userId = $(button).val();
            updateAccess(userId, newActive);
        }
    </script>
</head>
<body style="text-align: center; align-items: center">
<?php
session_start();
require_once "db_config.php";
include "navigation.php";

echo "<h1><br></h1><br>";

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$stmt_walkers = $dbh->query('SELECT * FROM walker');
$walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

$stmt_user = $dbh->query('SELECT * FROM user');
$users = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
?>
<h3>Walkers</h3>
<h5>Click on <button>disable</button> to disable a walker, or on <button>approve</button> to approve a walker</h5>
<table>
    <tr>
        <th>Image</th>
        <th>Username</th>
        <th>Firstname, lastname</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>City</th>
        <th>Country</th>
        <th>About</th>
        <th>Rating</th>
        <th>Active Status</th>
        <th>Accept/Disable</th>
    </tr>
    <?php foreach ($walkers as $walker): ?>
        <tr>
            <td><img src="<?= htmlspecialchars($walker['photo']) ?>" alt="walkerImage" style="width:50px; height:50px;"></td>
            <td><?= htmlspecialchars($walker['email']) ?></td>
            <td><?= htmlspecialchars($walker['fname']) ?> <?= htmlspecialchars($walker['lname']) ?></td>
            <td><?= htmlspecialchars($walker['phone_number']) ?></td>
            <td><?= htmlspecialchars($walker['address']) ?></td>
            <td><?= htmlspecialchars($walker['city']) ?></td>
            <td><?= htmlspecialchars($walker['country']) ?></td>
            <td><?= htmlspecialchars($walker['about']) ?></td>
            <?php if($walker['rating'] && $walker['ppl_rated']): ?>
                <td><?= htmlspecialchars(number_format($walker['rating'] / $walker['ppl_rated'], 2)) ?></td>
            <?php else: ?>
                <td>None yet</td>
            <?php endif; ?>
            <td><?= htmlspecialchars($walker['accept']) ?></td>
            <td>
                <?php if ($walker['approved'] == 0): ?>
                    <button value="<?= htmlspecialchars($walker['walker_id']) ?>" onclick="handleButtonClick(this, 1)">Accept</button>
                <?php else: ?>
                    <button value="<?= htmlspecialchars($walker['walker_id']) ?>" onclick="handleButtonClick(this, 0)">Disable</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Users</h3>
<h5>Click on <button>disable</button> to disable a user, or on <button>approve</button> to approve a user</h5>
<table>
    <tr>
        <th>Username</th>
        <th>Firstname, lastname</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>City</th>
        <th>Country</th>
        <th>Active Status</th>
        <th>Accept/Disable</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['fname']) ?> <?= htmlspecialchars($user['lname']) ?></td>
            <td><?= htmlspecialchars($user['phone_number']) ?></td>
            <td><?= htmlspecialchars($user['address']) ?></td>
            <td><?= htmlspecialchars($user['city']) ?></td>
            <td><?= htmlspecialchars($user['country']) ?></td>
            <td><?= htmlspecialchars($user['active']) ?></td>
            <td>
                <?php if ($user['admin_approved'] == 0): ?>
                    <button value="<?= htmlspecialchars($user['user_id']) ?>" onclick="handleButtonClickUser(this, 1)">Accept</button>
                <?php else: ?>
                    <button value="<?= htmlspecialchars($user['user_id']) ?>" onclick="handleButtonClickUser(this, 0)">Disable</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
