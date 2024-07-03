<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['name'], $_SESSION['role'])) {
    echo "<script>alert('Log in first'); window.location.href = 'index.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $activation_code = $_POST['activation_code'];
    $username = $_SESSION['name'];
    $user_type = $_SESSION['role'];

    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions


            $stmt = $dbh->prepare("SELECT dwp.walk_id, w.rating_enable, dwp.owner_name FROM dog_walking_appt dwp INNER JOIN walker w ON dwp.walker = w.email WHERE dwp.owner_name = :username AND w.rating_enable = :activation_code");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':activation_code', $activation_code, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $_SESSION['allowed'] = 1;
                $_SESSION['rating_walker'] = $activation_code;
                header("Location: diary.php");
                exit();
            } else {
                echo "<script>alert('Invalid activation code'); window.location.href = 'activate.php';</script>";
            }

    } catch (PDOException $e) {
        echo "Error: 333 " . $e->getMessage(); // Output any database errors
        exit();
    } catch (Exception $e) {
        echo "Error: 123" . $e->getMessage(); // Output any other unexpected errors
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Walker to rate</title>
	   <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        label, input, button {
            display: block;
            margin: 10px auto;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h3>Code of the walker</h3>
<form method="POST" action="rate_walker.php">
    <label for="activation_code">Enter the rating code:</label>
    <input type="text" id="activation_code" name="activation_code" required>
    <button type="submit">Activate</button>
</form>
</body>
</html>
