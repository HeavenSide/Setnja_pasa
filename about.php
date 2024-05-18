<?php
include "navigation.php";
?>


<!-- About Us Content -->
<div class="container section1" style="padding-top:80px">
    <div class="row">
        <div class="col-md-6">
            <h1>About Us</h1>
            <p>Welcome to Paws & Paths! We are passionate about providing high-quality dog walking services to ensure that your furry friends get the exercise and attention they need. Our team consists of dedicated professionals who are committed to the well-being and happiness of every dog we care for.</p>
            <p>At Paws & Paths, we understand that every dog is unique, which is why we offer personalized walking experiences tailored to your pet's specific needs and preferences. Whether your dog loves exploring new trails or simply enjoys a leisurely stroll around the neighborhood, we've got you covered!</p>
        </div>
        <div class="col-md-6">
            <img src="imgs/hero-image.png" class="img-fluid" alt="About Us Image">
        </div>
    </div>
</div>

<section class="container" style="padding-top: 30px">
    <div class="row">
        <div class="col-md-6">
            <h2>Our Mission</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis lectus eget velit ullamcorper ultrices.</p>
        </div>
        <div class="col-md-6">
            <h2>Our Vision</h2>
            <p>Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.</p>
        </div>
    </div>
</section>

<section class="container" style="padding: 5em">
    <h2 class="text-center mb-4">Most Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Question 1: What is Lorem Ipsum?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion"><!-- mozda dodati show da se prvo pitanje odma prikaze -->
                <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis lectus eget velit ullamcorper ultrices.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Question 2: Why do we use it?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                    Question 2: Why do we use it?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                    Question 2: Why do we use it?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                    Question 2: Why do we use it?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
                    Question 2: Why do we use it?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nulla facilisi. Mauris lacinia lectus quis risus eleifend, vel blandit ante laoreet. Vivamus ultrices ligula ac vehicula consectetur.
                </div>
            </div>
        </div>

    </div>
</section>



<?php
include "promotion.php";
?>

<?php
include "footer.php";
?>
