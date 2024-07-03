<?php
include "navigation.php";
require_once "db_config.php";

session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['role'])) {
    echo "<br><br><br>You are not logged in";
    exit();
}

$user_type = $_SESSION['role'];
$username = $_SESSION['name'];
$walker_id = isset($_GET['walker_id']) ? $_GET['walker_id'] : null;

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "";
$params = [];

if ($walker_id) {
    $sql = "SELECT * FROM walker WHERE walker_id = :walker_id AND NOT (walker_id=4224 OR walker_id=2442)";
    $params = [':walker_id' => $walker_id];
} elseif ($user_type == 'walker' || $user_type == 'admin') {
    $sql = "SELECT * FROM walker WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
    $params = [':username' => $username];
} elseif ($user_type == 'user') {
    $sql = "SELECT * FROM user WHERE email = :username";
    $params = [':username' => $username];
} else {
    echo "Invalid user type";
    exit();
}

$query = $dbh->prepare($sql);
$query->execute($params);
$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "No user found";
    exit();
}

$canEditProfile = true;
$canChangePassword = $user_type == 'walker' || $user_type == 'admin' || ($user_type == 'user' && !$walker_id);
$canContact = $user_type == 'user' && $walker_id;
$canHire = $user_type == 'user' && $walker_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
</head>
<body>
<?php if(isset($_GET['err'])){
    echo "<br><br><br><td style='border: 1px solid red;'>Mew password cannot be the same as the old password</td>";
} else if(isset($_GET['succ']) && $_GET['succ']==1){
    echo "<br><br><br>Password changed successfully";
} else if(isset($_GET['succ']) && $_GET['succ']==2){
    echo "<br><br><br>An unknown error has occurred, try again later";
}

?>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row profile-row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="profile-picture mt-5" src="<?php echo htmlspecialchars(isset($result['photo']) ? $result['photo'] : 'imgs/default-pfp.jpg'); ?>" ">
                <span class="font-weight-bold"><?php echo htmlspecialchars($result['email']); ?></span>
                <span class="text-black-50"><?php echo htmlspecialchars($result['email']) . "@gmail.com"; ?></span>
                <?php if (!empty($result['about'])): ?>
                    <p><?php echo htmlspecialchars($result['about']); ?></p>
                <?php endif; ?>
                <?php if (!isset($_GET['walker_id']) && isset($_SESSION['role'])): ?>
                    <button class="btn btn-primary mt-3" type="button" id="edit" onclick="editProfile()">Edit</button>
                    <div class="col-md-12">
                        <button type="button" id="saveButton" class="btn btn-primary mt-3" style="display: none;" onclick="submitForm()">Save</button>
                    </div>
                    <button class="btn btn-primary mt-3" id="changePasswordButton" onclick="showPasswordChange()">Change Password</button>
                <?php endif; ?>
                <?php
                if(isset($_SESSION['role']) && !isset($_GET['walker_id'])): ?>
                    <button class="btn btn-primary mt-3" id="delete"><a  href="delete_account.php" style="color: #f2f2f2">Delete account</a></button>
                <?php
                endif;?>
                <?php if ($canHire): ?>
                    <a href="booking.php?walker=<?php echo $walker_id; ?>" class="btn btn-primary mt-3">Hire</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6 border-right">
            <form id="profileForm" method="post" action="update_profile.php">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right"><?php echo htmlspecialchars($result['fname'] . " " . htmlspecialchars($result['lname'])); ?></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="pfname" class="labels"><b>Name</b></label>
                            <input id="pfname" name="pfname" type="text" class="form-control" placeholder="first name" value="<?php echo htmlspecialchars($result['fname']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pflname" class="labels"><b>Surname</b></label>
                            <input id="pflname" name="pflname" type="text" class="form-control" value="<?php echo htmlspecialchars($result['lname']); ?>" placeholder="surname" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="pfphone" class="labels"><b>Phone Number</b></label>
                            <input id="pfphone" name="pfphone" type="text" class="form-control" placeholder="enter phone number" value="<?php echo htmlspecialchars($result['phone_number']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="pfaddress" class="labels"><b>Address</b></label>
                            <input id="pfaddress" name="pfaddress" type="text" class="form-control" placeholder="enter address" value="<?php echo htmlspecialchars($result['address']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="pfemail" class="labels"><b>Email</b></label>
                            <input id="pfemail" name="pfemail" type="text" class="form-control" placeholder="enter email id" value="<?php echo htmlspecialchars($result['email']) . "@gmail.com"; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="pfcountry" class="labels"><b>Country</b></label>
                            <input id="pfcountry" name="pfcountry" type="text" class="form-control" placeholder="country" value="<?php echo htmlspecialchars($result['country']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pfcity" class="labels"><b>City</b></label>
                            <input id="pfcity" name="pfcity" type="text" class="form-control" value="<?php echo htmlspecialchars($result['city']); ?>" placeholder="city" readonly>
                        </div>
                    </div>
                    <?php if ($user_type == 'walker' || $user_type == 'admin'): ?>
                        <div class="col-md-12">
                            <label for="about" class="labels"><b>About</b></label>
                            <input id="about" name="about" type="text" class="form-control" value="<?php echo htmlspecialchars($result['about']); ?>" placeholder="about" readonly>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['role'] == 'walker' || $_SESSION['role'] == 'admin'): ?>
                        <div class="col-md-12">
                            <input type="checkbox" id="myCheckbox" name="myCheckbox" <?php echo ($result['accept'] == 1) ? 'checked' : ''; ?> disabled>
                            <label for="myCheckbox"><?php echo ($result['accept'] == 1) ? 'I am accepting walks' : 'I am not accepting walks'; ?></label>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="saveButton" class="btn btn-primary" style="display: none;">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr >
<?php if (isset($_GET['walker_id'])): ?>
    <div class="col-md-12">
        <label for="rating" class="labels">Rating & Comments</label
    </div>
    <?php
    $sql = $dbh->prepare("SELECT * FROM walks WHERE walker IN (SELECT email FROM walker WHERE walker_id=:walker_id)");
    $sql->bindParam(':walker_id', $walker_id, PDO::PARAM_INT);
    if ($sql->execute()) {
        $walks = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<table style='border: 2px solid black;'>";
        echo "<tr><th>Walker View</th><th>User View</th><th>Path</th><th>Duration</th><th>Rating</th></tr>";
        foreach ($walks as $walk) {
            echo "<tr style='border: 1px solid black;'>";
            echo "<td style='border: 1px solid black;'>" . htmlspecialchars($walk["walker_view"]) . "</td>";
            echo "<td style='border: 1px solid black;'>" . htmlspecialchars($walk["user_view"]) . "</td>";
            echo "<td style='border: 1px solid black;'>" . htmlspecialchars($walk["path"]) . "</td>";
            echo "<td style='border: 1px solid black;'>" . htmlspecialchars($walk["duration"]) . "</td>";
            echo "<td style='border: 1px solid black;'>" . htmlspecialchars($walk["walk_rating"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
<?php endif; ?>

<script>
    function editProfile() {
        var inputs = document.querySelectorAll('#profileForm input');
        inputs.forEach(function(input) {
            input.removeAttribute('readonly');
        });
        var checkbox = document.getElementById('myCheckbox');
        if (checkbox) {
            checkbox.removeAttribute('disabled');
        }
        document.getElementById('saveButton').style.display = 'inline';
    }

    function changePassword() {
        window.location.href = 'change_password.php';
    }

    function submitForm() {
        document.getElementById('profileForm').submit();
        document.getElementById('saveButton').style.display = 'none';
    }

    function showPasswordChange() {
        document.getElementById('passwordModal').style.display = 'block';
    }

    document.querySelector('.close').onclick = function() {
        document.getElementById('passwordModal').style.display = 'none';
    }

    document.getElementById('passwordForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        formData.append('username', "<?php echo htmlspecialchars($result['email']); ?>");

        fetch('update_password.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
            .then(data => {
                alert(data);
                document.getElementById('passwordModal').style.display = 'none';
            }).catch(error => console.error('Error:', error));
    });
</script>


<div id="passwordModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="passwordForm" method="post" action="update_password.php">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <button type="submit">Change Password</button>
        </form>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        outline: 0;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 800px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 0.3rem;
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        padding: 20px;
    }

    .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }

    .		profile-row .col-md-6,
    .profile-row .col-md-4 {
        margin: 0px 15px;
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }

    .close {
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        opacity: .5;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
        text-decoration: none;
        opacity: .75;
    }

    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1rem;
    }

    .modal-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        padding: 0.75rem;
        border-top: 1px solid #e9ecef;
        border-bottom-right-radius: 0.3rem;
        border-bottom-left-radius: 0.3rem;
    }

    .btn {
        margin-top: 10px;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: #000;
        opacity: .5;
    }

    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .profile-form .form-control {
        border-radius: 0.2rem;
    }

    .profile-form label {
        font-weight: bold;
    }

    .profile-picture {
        max-width: 150px;
        border-radius: 50%;
        margin-bottom: 20px;
    }
    .row{
        justify-content:center;
    }
</style>


</body>
</html>
