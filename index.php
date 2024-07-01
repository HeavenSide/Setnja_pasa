<?php
 include "navigation.php";
session_start();
?>

<!-- hero page (section #1) -->
<div id="section1" class="container-fluid bg-image-section1 d-flex align-items-end " style="padding-top:70px;padding-bottom:70px">
    <div class="text-overlay">
        <h1>Tail Wag</h1>
        <p>Unleash the Joy of Wagging Tails!<br>
            Your Pawsome Dog Walking Adventure Awaits!</p>
        <button type="button" class="btn btn-join" onclick="openSignupForm()">Join Us</button>
    </div>
</div>

    <!-- Our Team (section #2) -->
    <div id="section2" class="container-fluid justify-content-center align-items-center" style="padding-top:70px;padding-bottom:70px">
       <div class="center">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-overlay justify-center" >
                        <h1 style="color: black;">Our Dog Walking Team</h1>
                        <p>Dog Walking Experts Who Care: Our team of dedicated dog walkers not only walk your dogs – we care for them as if they were our own. With great attention to the individual needs of each dog and careful supervision during walks, we are here to provide your dogs with the best experience every time. Discover the difference our team can make in your dog's life.</p>
                        <p>Your Trusted Support for Dog Walking: Our team of dog walking experts is not just a team – we are your extended family. With careful selection and training of our dog walkers, you can be confident that your dogs are in the best hands while they are with us.'</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="image"><img src="imgs/happy-duggo.png" class="img-fluid" alt="Image"></div>
                </div>
            </div>
       </div>
    </div>

<!-- statistics section -->
<div id="statistics" class="container-fluid text-center py-5">
    <div class="row justify-content-center">
        <div class="stat col-md-2 col-sm-4 mb-3">
            <div class="content-box">
                <h1>1000+</h1>
                <p>Happy Pups</p>
            </div>
        </div>
        <div class="stat col-md-2 col-sm-4 mb-3">
            <div class="content-box">
                <h1>500+</h1>
                <p>Satisfied Owners</p>
            </div>
        </div>
        <div class="stat col-md-2 col-sm-4 mb-3">
            <div class="content-box">
                <h1>99%</h1>
                <p>Tail Wags Guaranteed</p>
            </div>
        </div>
    </div>
</div>

<!--- cards section-3 -->
<div id="section3" class="container-fluid vh-auto" style="padding-top:70px;padding-bottom:70px">
    <div class="text-overlay">
        <h1 class="text-center">Our Adventures</h1>
        <p class="text-center">Discover Our Doggy Adventures</p>
        <div class="row justify-content-center gx-3">

            <div class="card">
                <img class="card-img-top" src="imgs/cards/summer-adventure.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title"><b>Beach Day Shenanigans</b></h5>
                    <p class="card-text" style="font-size: 18px">Imagine this: a sunny day, the sound of waves crashing, and your dog living their best life on the beach. Their paws leave adorable prints in the sand as they race along the shoreline, ears flapping wildly in the wind. They dive into the surf with all the grace of a flailing otter, emerging drenched but ecstatic. </p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/stick-trail.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title"><b>The Great Stick Competition</b></h5>
                    <p class="card-text" style="font-size: 18px">In the ultimate stick competition, dogs of all sizes showcase their fetching prowess, each determined to bring back the biggest and best stick. With tails wagging furiously and eyes gleaming with excitement, they dash through the park, vying for the coveted title of "Stick Champion."</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/summer-adventure.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title"><b>Park and Chill</b></h5>
                    <p class="card-text" style="font-size: 18px">At the park, dogs and their owners find the perfect spot to relax and unwind, basking in the sun and enjoying the serene surroundings. As the dogs play and explore, their humans savor the moment, creating a peaceful and joyful escape from the daily grind.</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/witer-wonder.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title"><b>Winter Wonderland</b></h5>
                    <p class="card-text" style="font-size: 18px">On a snowy day, dogs transform into playful explorers, bounding through the powdery white landscape with endless enthusiasm. Their noses twitch with curiosity as they sniff out hidden treasures beneath the snow, leaving a trail of paw prints in their wake. With every frosty breath, they exude pure joy.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<hr>

<?php
include_once "cards.php";
?>

<!-- dog image (section #4)
<div id="section4" class="container-fluid bg-image-section4" style="padding-top:70px;padding-bottom:70px"></div>
 -->
<?php
include_once "promotion.php";
include_once "footer.php";
?>

