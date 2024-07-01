<?php
require_once 'db_config.php'; // Assuming this file contains database connection details
require_once 'functions.php'; // Assuming this file contains additional functions like LoginFailure()

session_start();

if (isset($_POST['nickname'], $_POST['logpassword'], $_POST['userTypeLI'])) {
    $username = strip_tags($_POST['nickname']); // Sanitize username
    $password = $_POST['logpassword'];
    $user_type = $_POST['userTypeLI'];

    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

        if ($user_type == 'premium') {
            $sql = "SELECT * FROM walker WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
        } elseif ($user_type == 'regular') {
            $sql = "SELECT * FROM user WHERE email = :username";
        } else {
            throw new Exception("Invalid user type.");
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Verify password using password_verify() assuming password is hashed in the database
            if (password_verify($password, $result['password'])) {
                if ($result['active'] == 0) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['userType'] = $user_type;
                    header("Location: activate.php");
                    exit();
                } elseif ($user_type=='premium' && $result['approved'] == 0) {
                    echo "<script>
                        alert('An admin has not yet approved your sign in request. Try tomorrow.');
                        window.location.href = 'index.php';
                    </script>";
                    exit();
                } elseif ($user_type=='regular' && $result['admin_approved'] == 0) {
                    echo "<script>
                        alert('Your account seems to be under suspension');
                        window.location.href = 'index.php';
                    </script>";
                    exit();
                } else {
                    $_SESSION['name'] = $result['email'];
                    $_SESSION['role'] = ($user_type == 'premium') ? 'walker' : 'user';
                    require_once 'sessions_handling.php';
                    echo "<script>
                        alert('Successfully logged in');
                        window.location.href = 'profile.php';
                    </script>";
                    exit();
                }
            } else {
                LoginFailure($username, $password, $dbh); // Handle failed login attempt
                echo "<script>
                    alert('Invalid username or password');
                    window.location.href = 'index.php';
                </script>";
                exit();
            }
        } else {
            LoginFailure($username, $password, $dbh); // Handle failed login attempt
            echo "<script>
                alert('Invalid username or password');
                window.location.href = 'index.php';
            </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Output any database errors
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage(); // Output any other unexpected errors
        exit();
    }
} else {
    header("Location: index.php"); // Redirect if POST data is not set
    exit();
}
