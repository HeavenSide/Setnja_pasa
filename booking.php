<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <link rel="stylesheet" type="text/css" href="css/booking.css">
</head>
<body>

<?php
include "navigation.php";
session_start();
require_once "db_config.php";
?>

<div class="booking-form" style="padding-top: 80px; width: 100%">
    <h2><b>Book a Dog Walker</b></h2>
    <form action="book_a_dog_walking.php" method="POST">
        <div class="row">
            <!-- Left column -->
            <div class="col-md-6">
                <!-- Username field -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>

                <!-- Dog's Name field -->
                <div class="form-group">
                    <label for="dogName">Dog's Name</label>
                    <input type="text" id="dogName" name="dogName" class="form-control" placeholder="Enter dog's name" required>
                </div>

                <!-- Breed field -->
                <div class="form-group">
                    <label for="dogBreed">Breed</label>
                    <input type="text" id="dogBreed" name="dogBreed" class="form-control" placeholder="Enter dog's breed" required>
                </div>

                <!-- Age field -->
                <div class="form-group">
                    <label for="dogAge">Age</label>
                    <input type="number" id="dogAge" name="dogAge" class="form-control" placeholder="Enter dog's age" required>
                </div>

                <!-- Country field -->
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" class="form-control" placeholder="Enter country" required>
                </div>
            </div>

            <!-- Right column -->
            <div class="col-md-6">
                <!-- Booking Date field -->
                <div class="form-group">
                    <label for="bookingDate">Booking Date</label>
                    <input type="date" id="bookingDate" name="bookingDate" class="form-control" required>
                </div>

                <!-- Start Time field -->
                <div class="form-group">
                    <label for="startTime">Start Time</label>
                    <input type="time" id="startTime" name="startTime" class="form-control" required>
                </div>

                <!-- End Time field -->
                <div class="form-group">
                    <label for="endTime">End Time</label>
                    <input type="time" id="endTime" name="endTime" class="form-control" required>
                </div>

                <!-- Dog Walker selection -->
                <div class="form-group">
                    <label for="dogWalker">Choose Dog Walker</label>
                    <select id="dogWalker" name="dogWalker" class="form-control" required>
                        <?php
                        if (!isset($_GET['walker'])) {
                            echo "<option value=\"-1\" hidden>Select a dog walker</option>";
                            $sql = "SELECT walker_id, email FROM walker WHERE active=1 AND accept=1 AND approved=1";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($results as $res) {
                                echo "<option value='" . $res['email'] . "'>" . $res['email'] . "</option>";
                            }
                        } elseif (isset($_GET['walker'])) {
                            $sql = "SELECT email FROM walker WHERE walker_id = :walker";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':walker', $_GET['walker'], PDO::PARAM_STR);
                            $query->execute();
                            $result = $query->fetch(PDO::FETCH_ASSOC);
                            echo "<option value='".$result['email']."'>" . $result['email'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Additional Comments -->
                <div class="form-group">
                    <label for="comments">Additional Comments</label>
                    <textarea id="comments" name="comments" class="form-control" placeholder="Enter any additional comments"></textarea>
                </div>
            </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="submit-btn btn btn-primary mt-3">Book Now</button>
    </form>
</div>

<div class="text-booking-abt">
    <div class="instruction-txt">
        <h2>Booking Instructions</h2>
        <div class="step">
            <div class="step-content">
                <h2><i class="fas fa-map-signs"></i> <b>Step 1: Embark on the Journey</b></h2>
                <p>Start by venturing into the digital realm of our website. Dive into the world of wagging tails and happy paws by logging into your account. If you're new to our pack, fear not! Sign up for an account and join the canine camaraderie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce et mollis sapien, a maximus ipsum.</p>
            </div>
        </div>
        <div class="step">
            <div class="step-content">
                <h2><i class="fas fa-calendar-alt"></i> <b>Step 2: Plot Your Path</b></h2>
                <p>Navigate through our virtual dog park to select the ideal date and time for your furry friend's walk. Explore the availability of our cheerful walkers, ensuring a tail-wagging experience that fits perfectly into your schedule. Integer et risus mi.</p>
            </div>
        </div>
        <div class="step">
            <div class="step-content">
                <h2><i class="fas fa-paw"></i> <b>Step 3: Paw-some Personalization</b></h2>
                <p>Share the unique traits and quirks of your beloved canine companion. From favorite treats to special instructions, let us know how we can tailor the walk to suit your dog's individual needs and preferences. Nullam sed felis luctus, gravida orci ac, ultricies elit.</p>
            </div>
        </div>
    </div>
</div>

<?php
include "promotion.php";
include "footer.php";
?>

</body>
</html>
