
<!DOCTYPE html>
<html>
<head>
    <title>Page 2</title>
    <link rel="stylesheet" type="text/css" href="log.css">

    <?php
    include "navigation.php"
    ?>

<section class="myform-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" style="box-shadow: rgba(0, 0, 0, 0.35) 0 5px 15px;">
                <div class="form-area login-form">
                    <div class="row">

                        <!-- Image background section -->
                        <div class="col-lg-6 img-bg">
                            <div class="form-content">
                                <h2>Sign Up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla non aperiam cum quas quod reprehenderit.</p>
                            </div>
                        </div>

                        <!-- Sign-up form section -->
                        <div class="col-lg-6">
                            <div class="form-input">
                                <h2>Sign Up Form</h2>
                                <form action="your_server_script.php" method="POST">

                                    <!-- Username -->
                                    <div class="form-group">
                                        <label for="username">E-mail:</label>
                                        <input type="text" id="username" name="username" class="form-control" required>
                                    </div>

                                    <!-- First Name -->
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first-name" class="form-control" required>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last-name" class="form-control" required>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" required>
                                    </div>

                                    <!-- Address -->
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control" required>
                                    </div>

                                    <!-- City -->
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" class="form-control" required>
                                    </div>

                                    <!-- Error Messages -->
                                    <div class="error-message mt-3">

                                    </div>

                                    <!-- User Type Group -->
                                    <div class="form-group">
                                        <label for="user-type">User Type</label>
                                        <div id="user-type" class="form-check">
                                            <input type="radio" id="walker" name="user-type" value="walker" class="form-check-input" required>
                                            <label for="walker" class="form-check-label">Walker</label>
                                        </div>
                                        <div id="user-type" class="form-check">
                                            <input type="radio" id="regular-user" name="user-type" value="regular-user" class="form-check-input" required>
                                            <label for="regular-user" class="form-check-label">Regular User</label>
                                        </div>

                                    </div>

                                    <!-- Rest of the form, including the submit button -->
                                    <div class="myform-button">
                                        <button type="submit" class="btn btn-success btn-block">Sign Up</button>
                                    </div>

                                    <!-- Error Messages -->
                                    <div class="error-message mt-3">
                                        <!-- This section can be used to display error messages after form submission -->
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

