<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cards.css">
    <title>Search for a walker</title>
    <style>
        /* Include the modal CSS from cards.php here */
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
    </style>
</head>
<body>
<div style="display: flex; justify-content: center; margin-top: 20px; padding: 80px 0 50px 0;">
    <div class="input-group" style="width: auto; display: flex;">
        <form class="d-flex" method="get" action="search_results.php" style="display: flex; align-items: center;">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" id="form1" style="flex-grow: 1; border: 2px solid black; width: 300px;">
            <button type="submit" class="btn btn-success" style="border-radius: 0; border: 2px solid black;">
                <i class="fas fa-search">Search</i>
            </button>
        </form>
    </div>
</div>

<div id="walkerProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="walkerProfileContent"></div>
    </div>
</div>

<?php
echo "<h1><br></h1>";
session_start();
include "navigation.php";
require_once "db_config.php";

if (isset($_GET['query'])) {
    $searchingFor = $_GET['query'];

    $stmt_walkers = $dbh->prepare('SELECT * FROM walker WHERE (email = :walkingDude OR fname = :walkingDude OR lname = :walkingDude) AND ppl_rated > 0 AND approved = 1 AND active = 1 ORDER BY rating / ppl_rated DESC');
    $stmt_walkers->bindParam(':walkingDude', $searchingFor, PDO::PARAM_STR);
    $stmt_walkers->execute();
    $walkers = $stmt_walkers->fetchAll(PDO::FETCH_ASSOC);

    foreach ($walkers as $walker) {
        echo '<div class="card-walkers"><img src="'.$walker['photo'].'" alt="User Image" style="width:100%"><h3>'.$walker['fname'].' '.$walker['lname'].'</h3><p>'.$walker['about'].
            '</p><button name="walker_id_button" class="hire-button" value="'.$walker['walker_id'].'" onclick="viewWalkerProfile('.$walker['walker_id'].')">View profile</button></div>';
    }
} else {
    echo "<p>No search query provided.</p>";
}
include "promotion.php";
include "footer.php";
?>

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
