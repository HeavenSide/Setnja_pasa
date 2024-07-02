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

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable PDO exceptions

if ($user_type == 'walker' || $user_type == 'admin') {
    $sql = "SELECT * FROM walker WHERE email = :username AND NOT (walker_id=4224 OR walker_id=2442)";
} elseif ($user_type == 'user') {
    $sql = "SELECT * FROM user WHERE email = :username";
}

$query = $dbh->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "No user found";
    exit();
}
?>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="150">

<div class="container rounded bg-white mt-5 mb-5 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
<div class="col-md-3 border-right">
    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <?php if (!empty($result['photo'])): ?>
            <img class="rounded-square mt-5" src="<?php echo htmlspecialchars($result['photo']); ?>" width="400" height="400">
        <?php else: ?>
            <img class="rounded-square mt-5" src="imgs/default-pfp.jpg" width="400" height="400">
        <?php endif; ?>
        <span class="font-weight-bold"><?php echo htmlspecialchars($result['email']); ?></span>
        <span class="text-black-50"><?php echo htmlspecialchars($result['email']) . "@gmail.com"; ?></span>
        <?php if (!empty($result['about'])): ?>
            <p><?php echo htmlspecialchars($result['about']); ?></p>
        <?php endif; ?>
        <p>In a field of mice, I will guide your dogs home</p>
        <?php if ($user_type == 'walker' || $user_type == 'admin'): ?>
            <div class="d-flex">
                <button class="btn btn-success me-2">Hire</button>
                <button id="contactButton" class="btn btn-primary">Contact</button>
            </div>
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
                            <label for="myCheckbox"><?php echo ($result['accept'] == 1) ? 'I am accepting walks' : 'I am not accepting walks'; ?></label>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-12">
                        <button name="pfpassword" id="pfpassword" class="btn btn-secondary mt-3">Change password</button>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="saveButton" class="btn btn-primary" style="display: none;">Save</button>
                    </div>
                </div>
            </form>
            <div class="p-3 py-5">


                    <div class="d-flex justify-content-between align-items-center experience">
   						<?php if ($user_type == 'walker' || $user_type == 'admin'): ?>
                         <span>Edit Profile</span>
      					 <span class="border px-3 p-1 add-experience">
           					<i class="fa fa-plus"></i>&nbsp;
            				<button type="button" id="edit" onclick="editProfile()" class="btn btn-success">Edit</button>
       					 </span>
   					 <?php endif; ?>
				</div>


               <!-- STARI KOD <div class="d-flex justify-content-between align-items-center experience">
                    <span>Edit Profile</span>
                    <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;<button type="button" id="edit" onclick="editProfile()" class="btn btn-success">Edit</button></span>
                </div>
                <br>
                <div class="col-md-12">
                    <label for="rating" class="labels">Rating & Comments</label>
                    <input id="rating" type="text" class="form-control" placeholder="experience" value="">
                </div> -->
            </div>
        </div>
    </div>
</div>

<div>
    <?php
    if ($user_type == 'walker' || $user_type == 'admin') {
        $sql = "SELECT * FROM dog_walking_appt WHERE walker = :username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $resultComments = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching records

        foreach($resultComments as $view): ?>
            <div>
                Walk <?php echo htmlspecialchars($view['id']) . ":<br>Walker: " . htmlspecialchars($view['walker_view']) . "<br>" . htmlspecialchars($view['user_view']) . "<br>Rating: " . htmlspecialchars($view['walk_rating'])."<br><hr>"; ?>
            </div>
        <?php endforeach;
    }
    ?>
</div>

<!-- Chatbox HTML -->
<div id="chatbox" class="chatbox">
    <div class="chatbox-header">
        <span>Contact Walker/User</span>
        <button id="closeChatbox" class="close-chatbox">X</button>
    </div>
    <div class="chatbox-body">
        <form id="chatForm">
            <input type="hidden" id="recipientType" name="recipientType" value="walker">
            <div class="mb-3">
                <label for="dogBreed" class="form-label">Dog Breed</label>
                <input type="text" id="dogBreed" name="dogBreed" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dogName" class="form-label">Dog Name</label>
                <input type="text" id="dogName" name="dogName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dogGender" class="form-label">Gender</label>
                <select id="dogGender" name="dogGender" class="form-select" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dogAge" class="form-label">Dog Age</label>
                <input type="number" id="dogAge" name="dogAge" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dogDescription" class="form-label">Description</label>
                <textarea id="dogDescription" name="dogDescription" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="dogSpecial" class="form-label">Special Requirements</label>
                <textarea id="dogSpecial" name="dogSpecial" class="form-control" rows="3" required></textarea>
            </div>
            <button type="button" id="sendChat" class="btn btn-primary">Send</button>
        </form>
        <div id="chatContent" class="chat-content"></div>
    </div>
</div>

<div class="clr" style="background-color: #114823; height: 78px"></div>
<?php include "footer.php"; ?>

<script>
    function editProfile() {
        var editButton = document.getElementById('edit');
        var saveButton = document.getElementById('saveButton');
        var isEditMode = editButton.innerText === "Save";

        var fields = ['pfname', 'pflname', 'pfphone', 'pfaddress', 'pfcountry', 'pfcity', 'myCheckbox', 'about'];

        fields.forEach(function(field) {
            var element = document.getElementById(field);
            if (element) {
                if (isEditMode) {
                    element.setAttribute('readonly', true);
                    if (element.type === 'checkbox') {
                        element.disabled = true;
                    }
                } else {
                    element.removeAttribute('readonly');
                    if (element.type === 'checkbox') {
                        element.disabled = false;
                    }
                }
            }
        });

        if (isEditMode) {
            editButton.innerText = "Edit";
            editButton.style.display="block";
            saveButton.style.display = "none";
        } else {
            editButton.innerText = "Save";
            editButton.style.display="none";
            saveButton.style.display = "block";
        }
    }

    document.getElementById('profileForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Profile updated successfully');
                location.reload();
            } else {
                alert('Error updating profile');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating profile');
        });
    });

    // Chatbox JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        var userType = "<?php echo $user_type; ?>"; // Get user type from PHP variable

        // Show chatbox for "walker" and "user"
        if (userType === 'walker' || userType === 'user') {
            document.getElementById('contactButton').addEventListener('click', function () {
                document.getElementById('chatbox').style.display = 'block';
                // Set recipient type based on user type
                document.getElementById('recipientType').value = (userType === 'walker') ? 'user' : 'walker';
            });

            document.getElementById('closeChatbox').addEventListener('click', function () {
                document.getElementById('chatbox').style.display = 'none';
            });

            document.getElementById('sendChat').addEventListener('click', function () {
                var chatForm = document.getElementById('chatForm');
                var formData = new FormData(chatForm);

                fetch('send_message.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var chatContent = document.getElementById('chatContent');
                        var newMessage = document.createElement('div');
                        newMessage.classList.add('chat-message');
                        newMessage.textContent = 'Message sent: ' + data.message;
                        chatContent.appendChild(newMessage);
                        chatForm.reset();
                    } else {
                        alert('Error sending message');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error sending message');
                });
            });
        }
    });
</script>


<style>
    .chatbox {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .chatbox-header {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .close-chatbox {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }
    .chatbox-body {
        padding: 10px;
    }
    .chat-content {
        max-height: 200px;
        overflow-y: auto;
        margin-bottom: 10px;
    }
    .chat-message {
        padding: 5px 10px;
        background-color: #f1f1f1;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .chat-input {
        width: calc(100% - 60px);
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .send-chat {
        width: 50px;
        padding: 5px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
</body>
