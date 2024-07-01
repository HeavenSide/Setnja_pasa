<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paws & Paths</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css"/>

    <style>
        /* Custom button styles */
        .btn-green {
            background-color: #28a745; /* Green background color */
            color: #fff; /* White text color */
            border-radius: 20px; /* Rounded corners */
        }

        .btn-green:hover,
        .btn-green:focus {
            background-color: #218838; /* Darker green on hover/focus */
            color: #fff;
        }

        /* Stilizacija popup formi */
        .login-form-popup, .signup-form-popup {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .login-form-container, .signup-form-container {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-offset="50">

<!-- Navigation -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top shadowed-div">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img alt="lg" src="imgs/logo.png" style="width: 60px; height: 40px; padding: 3px">
            Paws & Paths
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="index.php">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-link" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="nav-link">
                        <?php if(isset($_SESSION['name']) && $_SESSION['role']=='user'): ?>
                            <li><a class="dropdown-item" href="booking.php">Booking</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="walkers.php">Our Walkers</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="about.php">About</a>
                </li>

                <!-- Display appropriate buttons based on session status -->
                <?php if(!isset($_SESSION['name'])): ?>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link d-flex align-items-center" href="#" onclick="openLoginForm()">Log In</a>
                    </li>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link d-flex align-items-center" href="#" onclick="openSignupForm()">Sign Up</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link d-flex align-items-center" href="profile.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item d-sm-none">
                        <a class="nav-link d-flex align-items-center" href="logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="SIGN">
            <ul class="navbar-nav">
                <?php if(!isset($_SESSION['name'])): ?>
                    <li class="nav-item">
                        <button class="btn btn-green me-2" type="button" onclick="openLoginForm()">Log In</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-green" type="button" onclick="openSignupForm()">Sign Up</button>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-green me-2" href="profile.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-green" href="logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Popup form for login -->
<div id="loginFormPopup" class="login-form-popup">
    <div class="login-form-container">
        <span class="close" onclick="closeLoginForm()">&times;</span>
        <?php include "login.php"; ?>
    </div>
</div>

<!-- Popup form for signup -->
<div id="signupFormPopup" class="signup-form-popup">
    <div class="signup-form-container">
        <span class="close" onclick="closeSignupForm()">&times;</span>
        <?php include "signup.php"; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<!-- Custom JS for opening and closing forms -->
<script>
    function openLoginForm() {
        document.getElementById("loginFormPopup").style.display = "block";
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
