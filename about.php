<?php
include "navigation.php";
session_start();

?>

<div class="background-cont">
<!-- About Us Content -->
<div class="container section1" style="padding-top:80px">
    <div class="row">
        <div class="col-md-6">
            <h1><b>About Us</b></h1>
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
            <h2><b>Our Mission</b></h2>
            <p>At Paths & Paws, our mission is to provide exceptional care and companionship to every furry friend we walk. We are dedicated to ensuring that each walk is not just a stroll, but an enriching experience filled with love, safety, and joy. With every step, we strive to promote the health and happiness of both pets and their owners, building a stronger bond between them.</p>
        </div>
        <div class="col-md-6">
            <h2><b>Our Vision</b></h2>
            <p>Our vision at Paths & Paws is to be the leading provider of professional dog walking services, setting the standard for excellence in pet care. We envision a community where every dog receives the attention, exercise, and mental stimulation they need to thrive. Through our commitment to quality, reliability, and personalized service, we aim to enhance the lives of dogs and their owners, creating a world where every walk is a path to happiness.</p>
        </div>
    </div>
</section>

<hr style="border: none; height: 4px; background-color: #114823; margin: 20px 0;">

<!-- Questions Form -->
<section class="container" style="padding: 3em">
    <h2 class="text-center mb-4">Most Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <b>Question 1: What is Paths & Paws?</b>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Paths & Paws is a professional dog walking company dedicated to providing top-quality care and companionship for your furry friends.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                   <b>Question 2: How do I book a walk?</b>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Booking a walk with Paths & Paws is easy! Simply visit our website and fill out the booking form with your details and preferred walk time.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <b>Question 3: How much does a walk cost?</b>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    The cost of a walk with Paths & Paws depends on the duration and location of the walk. Please visit our pricing page for more information.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <b>Question 4: Are your walkers trained?</b>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, all of our walkers are trained professionals who have undergone rigorous training in dog handling, safety, and behavior.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                   <b> Question 5: Do you offer group walks?</b>
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, we offer group walks for dogs who enjoy socializing with other furry friends. Group walks are a great way for dogs to exercise and socialize in a safe environment.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <b>Question 6: Can I request a specific walker?</b>
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, you can request a specific walker when booking your walk with us. We will do our best to accommodate your request based on availability.
                </div>
            </div>
        </div>
    </div>
</section>


</div>

<?php
include "promotion.php";
?>

<?php
include "footer.php";
?>
