<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paws & Paths</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-offset="50">
<!-- Navigation -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top shadowed-div" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="container-fluid ">
        <a class="navbar-brand" href="#">Paws & Paths</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar" style="width: 89%;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-flex" href="dog_walk_index.php">Home</a>
                </li>

                <!-- "Services" dropdown menu for both mobile and desktop versions -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-link"  data-bs-toggle="dropdown" aria-expanded="false">Services
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="booking.php">Booking</a></li>
                        <li><a class="dropdown-item" href="walkers.php">Our Walkers</a></li>
                    </ul>
                </li>

                <!-- "Sign In/Sign Up" section for mobile version -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="Contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="about.php">About</a>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link d-flex align-items-center" href="login.php" >Log In</a>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link d-flex align-items-center" href="signup.php" >Sign Up</a>
                </li>
            </ul>
        </div>

        <!-- "Sign In/Sign Up" section for desktop version -->
        <div class="collapse navbar-collapse" id="SIGN" style="width: 200px; margin-right:1em;">
            <ul class="navbar-nav" >
                <li class="nav-item">
                    <form action="login.php" class="d-flex">
                        <button class="btn submit-btn log-sign"  type="submit">Log In</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="signup.php" class="d-flex" style="padding-left: 20px">
                        <button class="btn submit-btn log-sign" type="submit">Sign Up</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>

