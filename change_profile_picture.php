<?php
session_start();

if (!isset($_SESSION['name'])) {
    echo "<br><br><br>You are not logged in";
    exit();
}

if ($_SESSION['role'] !== 'walker' && $_SESSION['role'] !== 'admin') {
    echo "<br><br><br>Unable to access this page :(";
    exit();
}

require_once "db_config.php";

$username = $_SESSION['name'];
$error = '';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['newImage'])) {
    $newImage = $_FILES['newImage'];

    // Check if file is uploaded successfully
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        $file_name = $newImage['name'];
        $file_temp = $newImage['tmp_name'];
        $file_type = $newImage['type'];

        // Validate file type (e.g., only allow JPEG)
        if (exif_imagetype($file_temp) !== IMAGETYPE_JPEG) {
            $error = "The file type is not supported. Only JPEG files are allowed.";
        } else {
            $new_file_name = $username . ".jpg"; // Example: Use username as file name
            $upload_path = "imgs/walkers/" . $new_file_name;

            // Move uploaded file to destination
            if (move_uploaded_file($file_temp, $upload_path)) {
                // Update database with new photo path
                $sql = "UPDATE walker SET photo = :photo_path WHERE email = :username";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':photo_path', $upload_path, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo "<script>alert('Profile picture updated successfully');</script>";
                } else {
                    $error = "Failed to update profile picture in the database.";
                }
            } else {
                $error = "Failed to move uploaded file to destination.";
            }
        }
    } else {
        $error = "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Profile Picture</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
</head>
<body>
    <?php include "navigation.php"; ?>

    <div class="container mt-5" style="padding:50px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Change Profile Picture</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="newImage">Select Image (JPEG only)</label>
                        <input type="file" class="form-control-file" id="newImage" name="newImage" accept="image/jpeg">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
