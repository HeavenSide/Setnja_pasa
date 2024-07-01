<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin's Control</title>
    <style>
        table, th, td {
            border-top: 1px solid #1F8642;
            border-bottom: 1px solid #1F8642;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        .access-denied {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            border: 1px solid #ff0000;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
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
<body>
<br><br><br>
<?php
session_start();
require_once "db_config.php";
include "navigation.php";

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<p class='access-denied'>Access denied. You do not have the necessary permissions to view this page.</p>";
    exit();
}

$stmt_walkers = $dbh->query('SELECT * FROM walker');
$walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

$stmt_user = $dbh->query('SELECT * FROM user');
$users = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
?>
<h3>Walkers</h3>
<h5>Click on <button>disable</button> to disable a walker, or on <button>approve</button> to approve a walker</h5>
<table style="border-bottom: #1F8642; border-top: #1F8642">
    <tr style="border-top: 2px solid #1F8642; border-bottom: 2px solid #1F8642;">
        <td><b>Image</b></td>
        <td><b>Username</b></td>
        <td><b>Firstname, lastname</b></td>
        <td><b>Phone number</b></td>
        <td><b>Active Status</b></td>
        <td><b>Accept/Disable</b></td>
    </tr>
    <?php
    foreach($walkers as $walker)
    {
        echo "<tr>";
        echo "<td style='padding: 10px 20px;'><img src='".$walker['photo']."' alt='walkerImage' style='width:50px; height:50px;'></td>";
        echo "<td style='padding: 10px 20px;'><b>".$walker['email']."</b></td>";
        echo "<td style='padding: 10px 20px;'>".$walker['fname']." ".$walker['lname']."</td>";
        echo "<td style='padding: 10px 20px;'>".$walker['phone_number']."</td>";
        echo "<td style='padding: 10px 20px;'>".$walker['active']."</td>";
        if($walker['active'] == 0) {
            echo "<td><button value='".$walker['walker_id']."' id='accept' onclick='handleButtonClick(this, 1)'>Accept</button></td>";
        } else {
            echo "<td><button value='".$walker['walker_id']."' id='disable' onclick='handleButtonClick(this, 0)'>Disable</button></td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<h3>Users</h3>
<h5>Click on <button>disable</button> to disable a user, or on <button>approve</button> to approve a user</h5>
<table style="border-bottom: #1F8642; border-top: #1F8642">
    <tr style="border-top: 2px solid #1F8642; border-bottom: 2px solid #1F8642;">
        <td><b>Username</b></td>
        <td><b>Firstname, lastname</b></td>
        <td><b>Phone number</b></td>
        <td><b>Active Status</b></td>
        <td><b>Accept/Disable</b></td>
    </tr>
    <?php
    foreach($users as $user)
    {
        echo "<tr>";
        echo "<td style='padding: 10px 20px;'><b>".$user['email']."</b></td>";
        echo "<td style='padding: 10px 20px;'>".$user['fname']." ".$user['lname']."</td>";
        echo "<td style='padding: 10px 20px;'>".$user['phone_number']."</td>";
        echo "<td style='padding: 10px 20px;'>".$user['active']."</td>";
        if($user['active'] == 0) {
            echo "<td><button value='".$user['user_id']."' id='accept' onclick='handleButtonClickUser(this, 1)'>Accept</button></td>";
        } else {
            echo "<td><button value='".$user['user_id']."' id='disable' onclick='handleButtonClickUser(this, 0)'>Disable</button></td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
