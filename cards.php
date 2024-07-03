<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cards.css">
    <title>Walker Listings</title>
    <style>
        #walkerProfileContent {
            height: auto;
            overflow: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .modal-content img {
            max-width: 100%;
            height: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @media (min-width: 600px) {
            .modal-content {
                width: 70%;
                max-width: 600px;
            }
        }

        @media (min-width: 768px) {
            .modal-content {
                width: 60%;
                max-width: 700px;
            }
        }

        @media (min-width: 992px) {
            .modal-content {
                width: 50%;
                max-width: 800px;
            }
        }

        @media (min-width: 1200px) {
            .modal-content {
                width: 40%;
                max-width: 900px;
            }
        }

        hr {
            border-top: 10px #1F8642 solid;
        }

        .container-main-walkers {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .container-walkers {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            width: 100%;
            padding-bottom: 30px;
        }

        .card-walkers {
            flex: 1 1 calc(20% - 40px);
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,1);
            text-align: left;
            margin: 20px;
            padding: 10px;
            height: 400px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.3s ease;
        }

        .card-walkers:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,2);
        }

        .card-walkers img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .card-walkers h3 {
            margin: 10px 0;
        }

        .card-walkers p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        .card-walkers button {
            align-self: flex-end;
            background-color: #1F8642;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0; /* Add margin to ensure button stays within the card */
        }

        .card-walkers button:hover {
            background-color: #275e4d;
        }

        @media only screen and (max-width: 1024px) {
            .card-walkers {
                flex: 1 1 calc(45% - 40px);
                margin: 10px;
            }
        }

        @media only screen and (max-width: 768px) {
            .card-walkers {
                flex: 1 1 calc(50% - 40px);
                margin: 10px;
            }
        }

        @media only screen and (max-width: 480px) {
            .card-walkers {
                flex: 1 1 calc(100% - 40px);
                margin: 10px 0;
            }
        }
    </style>
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

<div id="walkerProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="walkerProfileContent"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var hireButtons = document.getElementsByClassName('hire-button');

        Array.from(hireButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                var walkerId = this.value;
                fetch('profile.php?walker_id=' + walkerId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
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

        document.getElementsByClassName('close')[0].addEventListener('click', function() {
            document.getElementById('walkerProfileModal').style.display = 'none';
        });

        window.onclick = function(event) {
            if (event.target == document.getElementById('walkerProfileModal')) {
                document.getElementById('walkerProfileModal').style.display = 'none';
            }
        };
    });
</script>

</body>
</html>
