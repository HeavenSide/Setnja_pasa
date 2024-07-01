<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cards.css">
    <title>Walker Listings</title>
</head>
<body>
<div class="container-main-walkers">
    <h1 class="card-title"><b>Best Rated Walkers</b></h1>
    <div class="container-walkers">
        <?php
        session_start();
        require_once "db_config.php";

        $stmt_walkers = $dbh->query('SELECT walker_id, email, about, fname, lname, rating, ppl_rated, photo, (rating / ppl_rated) AS rating_ratio FROM walker WHERE ppl_rated > 0 ORDER BY rating_ratio DESC LIMIT 5');
        $walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

        foreach($walkers as $walker)
        {
            echo '<div class="card-walkers"><img src="'.$walker['photo'].'" alt="User Image" style="width:100%"><h3>'.$walker['fname'].' '.$walker['lname'].'</h3><p>'.$walker['about'].
                '</p><button name="walker_id_button" class="hire-button" value="'.$walker['walker_id'].'" onclick="viewWalkerProfile('.$walker['walker_id'].')">View profile</button></div>';
        }
        ?>
    </div>
</div>
<div class="container-main-walkers">
    <h1 class="card-title"><b>Most Active Walkers</b></h1>
    <div class="container-walkers">
        <?php
        require_once "db_config.php";

        $stmt_walkers = $dbh->query('SELECT walker_id, email, about, fname, lname, rating, ppl_rated, photo, (rating / ppl_rated) AS rating_ratio FROM walker WHERE ppl_rated > 0 ORDER BY ppl_rated DESC LIMIT 5');
        $walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

        foreach($walkers as $walker)
        {
            echo '<div class="card-walkers"><img src="'.$walker['photo'].'" alt="User Image" style="width:100%"><h3>'.$walker['fname'].' '.$walker['lname'].'</h3><p>'.$walker['about'].
                '</p><button name="walker_id_button" class="hire-button" value="'.$walker['walker_id'].'" onclick="viewWalkerProfile('.$walker['walker_id'].')">View profile</button></div>';
        }
        ?>
    </div>
</div>

<!-- JavaScript za prikaz profila walkera -->
<div id="walkerProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="walkerProfileContent"></div>
    </div>
</div>

<script>
    function viewWalkerProfile(walkerId) {
        window.location.href = 'profile.php?walker_id=' + walkerId;
    }

document.addEventListener('DOMContentLoaded', function () {
        var hireButtons = document.getElementsByClassName('hire-button');

        Array.from(hireButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                var walkerId = this.value;
                fetch('get_walker_profile.php?id=' + walkerId)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('walkerProfileContent').innerHTML = data;
                        document.getElementById('walkerProfileModal').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading walker profile');
                    });
            });
        });

        // Close modal when close button is clicked
        document.getElementsByClassName('close')[0].addEventListener('click', function() {
            document.getElementById('walkerProfileModal').style.display = 'none';
        });

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('walkerProfileModal')) {
                document.getElementById('walkerProfileModal').style.display = 'none';
            }
        };
    });
</script>

</body>
</html>