<!DOCTYPE html>
<html>
<head>
    <title>Page 2</title>
    <!-- Include CSS for Page 2 -->
    <link rel="stylesheet" type="text/css" href="log.css">

    <?php
    include "navigation.php"
    ?>

<body>

<section class="myform-area" style="justify-content: center; padding: 5em">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8" style="box-shadow: rgba(0, 0, 0, 0.35) 0 5px 15px;">

                <div class="form-area login-form">
                    <div class="row">

                        <div class="col-lg-6 img-bg">
                            <div class="form-content">
                                <h2>Login</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla non aperiam cum quas quod reprehenderit.</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <h2>Login Form</h2>
                                <form>
                                    <div class="form-group">
                                        <input type="text" id="name" name="name" class="form-control" required>
                                        <label for="name">User Name</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control" required>
                                        <label for="password">Password</label>
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
                                        <div id="user-type" class="form-check">
                                            <input type="radio" id="admin" name="user-type" value="admin" class="form-check-input" required>
                                            <label for="admin" class="form-check-label">Admin</label>
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

</body>
</html>