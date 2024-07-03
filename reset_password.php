<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $reset_token = $_POST['token'];

    if ($new_password != $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        try {
            // Check if the reset token exists in the user table
            $sql = "SELECT * FROM user WHERE reset_password=:token";
            $query = $dbh->prepare($sql);
            $query->bindParam(':token', $reset_token, PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // If not found in user table, check the walker table
            if (!$user) {
                $sql = "SELECT * FROM walker WHERE reset_password=:token";
                $query = $dbh->prepare($sql);
                $query->bindParam(':token', $reset_token, PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                $table = 'walker';
            } else {
                $table = 'user';
            }

            if ($user) {
                // Check if the new password is the same as the old password
                if (password_verify($new_password, $user['password'])) {
                    echo "<script>window.location.href = 'forgotten_password.php?passwd=1';</script>";
                } else {
                    // Hash the new password and update the database
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $update_sql = "UPDATE $table SET password=:password, reset_password=NULL WHERE reset_password=:token";
                    $update_query = $dbh->prepare($update_sql);
                    $update_query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                    $update_query->bindParam(':token', $reset_token, PDO::PARAM_STR);
                    $update_query->execute();

                    echo "<script>alert('Password reset successfully.');</script>";
                    echo "<script>window.location.href = 'login.php';</script>";
                }
            } else {
                echo "<script>alert('Invalid or expired token.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('An error occurred. Please try again later.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
<?php
include "navigation.php";
?>
<div style="display: flex; justify-content: center; margin-top: 20px; padding: 80px 0 50px 0;">
    <form action="reset_password.php" method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-success" style="border-radius: 0; border: 2px solid black;">Reset Password</button>
    </form>
</div>
</body>
</html>
  