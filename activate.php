<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['username'], $_SESSION['password'], $_SESSION['userType'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $activation_code = $_POST['activation_code'];
    $username = $_SESSION['username'];
    $user_type = $_SESSION['userType'];

    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

        if ($user_type == 'premium') {
            $sql = "SELECT * FROM walker WHERE email = :username AND activation_code = :activation_code";
        } elseif ($user_type == 'regular') {
            $sql = "SELECT * FROM user WHERE email = :username AND activation_code = :activation_code";
        } else {
            throw new Exception("Invalid user type.");
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':activation_code', $activation_code, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($user_type == 'premium') {
                $update_sql = "UPDATE walker SET active = 1 WHERE email = :username";
                $update_query = $dbh->prepare($update_sql);
                $update_query->bindParam(':username', $username, PDO::PARAM_STR);
                $update_query->execute();

                if ($result['approved'] == 0) {
                    echo "<script>
                        alert('Your account has been activated but still needs admin approval.');
                        window.location.href = 'index.php';
                    </script>";
                    session_destroy();
                } else {
                    $_SESSION['name'] = $result['email'];
                    $_SESSION['role'] = 'walker';
                    header("Location: contact.php");
                    exit();
                }
            } elseif ($user_type == 'regular') {
                $update_sql = "UPDATE user SET active = 1 WHERE email = :username";
                $update_query = $dbh->prepare($update_sql);
                $update_query->bindParam(':username', $username, PDO::PARAM_STR);
                $update_query->execute();

                $_SESSION['name'] = $result['email'];
                $_SESSION['role'] = 'user';
                header("Location: contact.php");
                exit();
            }
        } else {
            echo "<script>
                alert('Invalid activation code');
                window.location.href = 'activate.php';
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Output any database errors
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage(); // Output any other unexpected errors
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Activation</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 80px; /* Dodajemo padding na vrhu cijelog body-ja */
        }
        .container {
            text-align: center;
            margin-top: -60px; /* Ovo možete prilagoditi prema potrebi */
        }
        h3 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        form {
            font-size: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, input, button {
            margin: 10px 0;
        }
        input {
            padding: 10px;
            font-size: 18px;
            border: 2px solid black;
            width: 300px;
        }
        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            width: 300px;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Account Activation</h3>
        <form method="POST" action="activate.php">
            <label for="activation_code">Enter your activation code:</label>
            <input type="text" id="activation_code" name="activation_code" required>
            <button type="submit">Activate</button>
        </form>
    </div>
</body>
</html>
