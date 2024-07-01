<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form id="loginForm" action="log_in_process.php" method="post">
    <h2>Login</h2>
    <label for="nickname">Nickname:</label>
    <input type="text" id="nickname" name="nickname" required>

    <label for="logpassword">Password:</label>
    <input type="password" id="logpassword" name="logpassword" required>

    <label for="userType">User Type:</label><br>
    <select id="userTypeLI" name="userTypeLI">
        <option value="regular">User</option>
        <option value="premium">Walker</option>
    </select>

    <input type="submit" value="Submit">

    <p>Don't have an account? <a href="#" onclick="openSignupForm()">Sign up here</a>.</p>
</form>


   <p>Forgot your password? <a href="forgotten_password.php">Click here</a> to reset it.
</p>
</form>

<!-- JavaScript za otvaranje i zatvaranje formi -->
<script>
    function openSignupForm() {
        document.getElementById("signupForm").style.display = "block";
        document.getElementById("loginForm").style.display = "none"; // Zatvara login formu
    }

    function openLoginForm() {
        document.getElementById("loginForm").style.display = "block";
        document.getElementById("signupForm").style.display = "none"; // Zatvara signup formu
    }
</script>

</body>
</html>
