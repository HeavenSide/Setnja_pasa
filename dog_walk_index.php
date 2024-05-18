<?php
 include "navigation.php";
?>

<!-- hero page (section #1) -->
<div id="section1" class="container-fluid bg-image-section1 d-flex align-items-end " style="padding-top:70px;padding-bottom:70px">
    <div class="text-overlay">
        <h1>Tail Wag</h1>
        <p>Unleash the Joy of Wagging Tails!<br>
            Your Pawsome Dog Walking Adventure Awaits!</p>
        <button type="button" class="btn btn-join ">Join Now</button>
    </div>
</div>

    <!-- Our Team (section #2) -->
    <div id="section2" class="container-fluid justify-content-center align-items-center" style="padding-top:70px;padding-bottom:70px">
       <div class="center">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-overlay justify-center" >
                        <h1 style="color: black;">Our Dog Walking Team</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
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
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/stick-trail.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/summer-adventure.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="imgs/cards/witer-wonder.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- dog image (section #4) -->
<div id="section4" class="container-fluid bg-image-section4" style="padding-top:70px;padding-bottom:70px"></div>

<div id="join-us" class="join-us justify-content-center align-items-center">
    <div class="text-center">
        <h1>Join Our Pack Today!</h1>
        <h2>Let’s Make Your Day Brighter with Every Wag and Woof!</h2>
        <div class="button-section">
            <button class="btn">Join Us</button>
            <button class="btn">Meet the Team</button>
        </div>
    </div>
</div>

<!-- footer -->
<?php
include "footer.php";
?>