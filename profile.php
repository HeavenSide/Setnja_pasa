<?php
include "navigation.php";
require_once "db_config.php";

session_start();

if (!isset($_SESSION['name']) && !isset($_SESSION['role'])) {
    echo "<br><br><br>You are not logged in";
    exit();
}

$user_type = $_SESSION['role'];
$username = $_SESSION['name'];

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

// Check if a walker_id parameter is present in the URL
if (isset($_GET['walker_id'])) {
    $walker_id = $_GET['walker_id'];
    $sql = "SELECT * FROM walker WHERE walker_id = :walker_id AND NOT (walker_id=4224 OR walker_id=2442)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':walker_id', $walker_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
} else {
    // Load the current user's profile
    if ($user_type == 'walker' || $user_type == 'admin') {
        $sql = "SELECT * FROM walker WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
    } elseif ($user_type == 'user') {
        $sql = "SELECT * FROM user WHERE email = :username";
    }

    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
}

if (!$result) {
    echo "No user found";
    exit();
}
?>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="150">

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <?php if (!empty($result['photo'])): ?>
                    <img class="rounded-square mt-5" src="<?php echo htmlspecialchars($result['photo']); ?>">
                <?php endif; ?>
                <span class="font-weight-bold"><?php echo htmlspecialchars($result['email']); ?></span>
                <span class="text-black-50"><?php echo htmlspecialchars($result['email']) . "@gmail.com"; ?></span>
                <?php if (!empty($result['about'])): ?>
                    <p><?php echo htmlspecialchars($result['about']); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <form id="profileForm">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right"><?php echo htmlspecialchars($result['fname']) . " " . htmlspecialchars($result['lname']); ?></h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="pfname" class="labels">Name</label>
                            <input id="pfname" name="pfname" type="text" class="form-control" placeholder="first name" value="<?php echo htmlspecialchars($result['fname']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pflname" class="labels">Surname</label>
                            <input id="pflname" name="pflname" type="text" class="form-control" value="<?php echo htmlspecialchars($result['lname']); ?>" placeholder="surname" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="pfphone" class="labels">Phone Number</label>
                            <input id="pfphone" name="pfphone" type="text" class="form-control" placeholder="enter phone number" value="<?php echo htmlspecialchars($result['phone_number']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="pfaddress" class="labels">Address</label>
                            <input id="pfaddress" name="pfaddress" type="text" class="form-control" placeholder="enter address" value="<?php echo htmlspecialchars($result['address']); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="pfemail" class="labels">Email</label>
                            <input id="pfemail" name="pfemail" type="text" class="form-control" placeholder="enter email id" value="<?php echo htmlspecialchars($result['email']) . "@gmail.com"; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="pfcountry" class="labels">Country</label>
                            <input id="pfcountry" name="pfcountry" type="text" class="form-control" placeholder="country" value="<?php echo htmlspecialchars($result['country']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pfcity" class="labels">City</label>
                            <input id="pfcity" name="pfcity" type="text" class="form-control" value="<?php echo htmlspecialchars($result['city']); ?>" placeholder="city" readonly>
                        </div>
                    </div>
                    <?php if ($user_type == 'walker' && !empty($result['about'])): ?>
                        <div class="col-md-12">
                            <label for="about" class="labels">About</label>
                            <input id="about" name="about" type="text" class="form-control" value="<?php echo htmlspecialchars($result['about']); ?>" placeholder="about" readonly>
                        </div>
                    <?php endif; ?>
                    <?php if ($user_type == 'walker'): ?>
                        <div class="col-md-12">
                            <input type="checkbox" id="myCheckbox" name="myCheckbox" <?php echo ($result['accept'] == 1) ? 'checked' : ''; ?> disabled>
                            <label for="acceptingCheckbox">Accepting</label>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
