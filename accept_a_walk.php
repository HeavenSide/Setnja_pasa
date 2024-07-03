<?php

require_once "db_config.php";
include "navigation.php";
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'walker' && $_SESSION['role'] !== 'admin')) {
    echo "<p class='access-denied'>You are not a walker, so you cannot accept walks.</p>";
    exit();
}

// Prepare the query
$stmt_walking = $dbh->prepare('
    SELECT 
        dwp.walk_id, 
        dwp.walker, 
        dwp.owner_name, 
        u.phone_number, 
        dwp.dog_name, 
        dwp.breed, 
        dwp.age, 
        dwp.booking_date, 
        dwp.start_time, 
        dwp.end_time, 
        dwp.accepted, 
        dwp.done,
        dwp.replied
    FROM dog_walking_appt dwp 
    INNER JOIN user u 
    ON u.email = dwp.owner_name 
    WHERE dwp.walker = :walker AND dwp.replied=0
');

// Bind the parameter
$stmt_walking->bindParam(':walker', $_SESSION['name'], PDO::PARAM_STR);

// Execute the query
$stmt_walking->execute();

// Fetch the results
$walking = $stmt_walking->fetchAll(PDO::FETCH_ASSOC);
echo "<br><br><br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested walks</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #1F8642;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #1F8642;
            color: white;
        }
        .button-container {
            display: flex;
            gap: 10px;
        }
        .button-container button {
            padding: 5px 10px;
            cursor: pointer;
        }
        .access-denied {
            color: red;
            font-weight: bold;
            margin: 20px;
        }
        footer {
            background-color: #f2f2f2;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
<div class="content">
    <h3><b>Requested walks:</b></h3>
    <?php if (empty($walking)): ?>
        <p>No walks found.</p>
    <?php else: ?>
        <small>Click on <button>decline</button> to refuse a walk, or on <button>accept</button> to accept a walk.</small>
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Phone number</th>
                <th>Dog's name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Start time - End time</th>
                <th>Date</th>
                <th>Accept/Refuse</th>
                <th>Done</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($walking as $walks): ?>
                <tr>
                    <td style='padding: 10px 20px;'><?php echo $walks['owner_name']; ?></td>
                    <td style='padding: 10px 20px;'><b><?php echo $walks['phone_number']; ?></b></td>
                    <td style='padding: 10px 20px;'><?php echo $walks['dog_name']; ?></td>
                    <td style='padding: 10px 20px;'><?php echo $walks['breed']; ?></td>
                    <td style='padding: 10px 20px;'><?php echo $walks['age']; ?></td>
                    <td style='padding: 10px 20px;'><?php echo $walks['start_time']." - ".$walks['end_time']; ?></td>
                    <td style='padding: 10px 20px;'><?php echo $walks['booking_date']; ?></td>
                    <?php if (($walks['accepted'] == 0 || $walks['accepted'] == 1) && $walks['done'] == 0): ?>
                        <td><button value='<?php echo $walks['walk_id']; ?>' id='accept' onclick='handleButtonClick(this, 1)'>Accept</button>
                            <button value='<?php echo $walks['walk_id']; ?>' id='disable' onclick='handleButtonClick(this, 0)'>Refuse</button><?php if($walks['accepted'] == 1) echo "Walk already accepted"; ?></td>
                    <?php
                    endif;
                    if($walks['accepted'] == 1 && $walks['done'] == 0): ?>
                        <td><button value='<?php echo $walks['walk_id']; ?>' id='done' onclick='handleButtonClick(this, 2)'>Done</button></td>
                    <?php elseif ($walks['accepted'] == 0):?>
                        <td><button value='<?php echo $walks['walk_id']; ?>' id='done' onclick='handleButtonClick(this, 2)' disabled>Done</button></td>
                    <?php
                    endif;
                    if($walks['accepted'] == 1 && $walks['done'] == 1): ?>
                        <td colspan='2'>This walk is done</td>
                    <?php endif; ?>
                    <?php if($walks['accepted'] == 0 && $walks['done'] == 1): ?>
                        <td colspan='2'>There appears to be an error with your account</td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<footer>
    <?php include "footer.php"; ?>
</footer>

<script>
    function handleButtonClick(button, action) {
        const id = button.value;
        let url = 'update_walk_status.php';
        let data = { id: id, action: action };

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error updating walk status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
</body>
</html>
