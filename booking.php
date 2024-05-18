
<!DOCTYPE html>
<html>
<head>
    <title>Page 2</title>
    <!-- Include CSS for Page 2 -->
    <link rel="stylesheet" type="text/css" href="booking.css">

<?php
include "navigation.php"
?>

<div class="booking-form">
    <h2>Book a Dog Walker</h2>
    <form action="#" method="POST">
        <!-- Username field -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
        </div>

        <!-- Existing fields -->
        <div class="form-group">
            <label for="dogName">Dog's Name</label>
            <input type="text" id="dogName" name="dogName" class="form-control" placeholder="Enter dog's name" required>
        </div>

        <div class="form-group">
            <label for="dogBreed">Breed</label>
            <input type="text" id="dogBreed" name="dogBreed" class="form-control" placeholder="Enter dog's breed" required>
        </div>

        <div class="form-group">
            <label for="dogAge">Age</label>
            <input type="number" id="dogAge" name="dogAge" class="form-control" placeholder="Enter dog's age" required>
        </div>

        <div class="form-group">
            <label for="bookingDate">Booking Date</label>
            <input type="date" id="bookingDate" name="bookingDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="startTime">Start Time</label>
            <input type="time" id="startTime" name="startTime" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="endTime">End Time</label>
            <input type="time" id="endTime" name="endTime" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="dogWalker">Choose Dog Walker</label>
            <select id="dogWalker" name="dogWalker" class="form-control" required>
                <option value="" hidden>Select a dog walker</option>
                <option value="walker1">Walker 1</option>
                <option value="walker2">Walker 2</option>
                <option value="walker3">Walker 3</option>
            </select>
        </div>

        <button type="submit" class="submit-btn">Book Now</button>
    </form>
</div>
