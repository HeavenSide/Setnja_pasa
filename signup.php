<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea,
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
        .walker-fields {
            display: none;
        }
        small {
            color: red;
            display: none;
        }
    </style>
    <script src="test.js"></script>
</head>
<body>
    <?php
session_start();
?>

<form id="signingUpForm" action="sign_up_processing.php" method="post" enctype="multipart/form-data">
    <h2>Sign Up</h2>
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>
    <small></small><br>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>
    <small></small><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <small></small><br>

    <label for="phone">Phone number:</label>
    <textarea id="phone" name="phone" rows="1" required></textarea>
    <small></small><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <small></small><br>

    <label for="address">Address:</label>
    <textarea id="address" name="address" rows="1" required></textarea>
    <small></small><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>
    <small></small><br>

    <label for="country">Country:</label>
    <input type="text" id="country" name="country" required>
    <small></small><br>

    <label for="userType">User Type:</label><br>
    <select id="userType" name="userType" required onchange="toggleWalkerFields()">
        <option value="regular">User</option>
        <option value="premium">Walker</option>
    </select>
    <small></small><br>

    <div class="walker-fields" id="walkerFields">
        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/jpeg">
        <small></small><br>
    </div>

    <input type="submit" value="Sign Up" id="submit">
    <p>Already have an account? <a href="#" onclick="openLoginForm()">Log in here</a>.</p>
</form>

<!-- JavaScript for toggling fields -->
<script>
    function toggleWalkerFields() {
        var userType = document.getElementById("userType").value;
        var walkerFields = document.getElementById("walkerFields");
        if (userType === "premium") {
            walkerFields.style.display = "block";
        } else {
            walkerFields.style.display = "none";
        }
    }

    function openLoginForm() {
        document.getElementById("loginFormPopup").style.display = "block";
        document.getElementById("signupFormPopup").style.display = "none";
    }

    function closeLoginForm() {
        document.getElementById("loginFormPopup").style.display = "none";
    }

    function openSignupForm() {
        document.getElementById("signupFormPopup").style.display = "block";
    }

    function closeSignupForm() {
        document.getElementById("signupFormPopup").style.display = "none";
    }
</script>
</body>
</html>
