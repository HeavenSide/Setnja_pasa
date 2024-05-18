<?php
include "navigation.php";
?>

<div class="background-hero-img">
    <div class="padding-class" style="padding-top: 124px; padding-bottom: 123px">
    <div  id="bg-container " class="container transparent-bg py-5" >

        <div class="row g-5" >

            <!-- Contact Information Block -->
            <div class="col-xl-6 location-map">
                <h2 class="pb-4" style="color: white">Our Office Contact</h2>
                <div class="row row-cols-md-2 g-4">
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="aos-item__inner">
                            <div class="bg-light hvr-shutter-out-horizontal d-block p-3">
                                <div class="d-flex justify-content-start">
                                    <i class="fa-solid fa-envelope h3 pe-2"></i>
                                    <span class="h5">Email</span>
                                </div>
                                <span>example@domain.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="aos-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="aos-item__inner">
                            <div class="bg-light hvr-shutter-out-horizontal d-block p-3">
                                <div class="d-flex justify-content-start">
                                    <i class="fa-solid fa-phone h3 pe-2"></i>
                                    <span class="h5">Phone</span>
                                </div>
                                <span>+0123456789, +9876543210</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="aos-item" data-aos="fade-up" data-aos-delay="800">
                    <div class="mt-4 w-100 aos-item__inner">
                        <iframe class="hvr-shadow" width="100%" height="345" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2795.6323612760217!2d19.67368451569028!3d46.09745307911407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47672e6f4bdc5d55%3A0xe86a901e5852ad28!2z0JHRg9C70L7RgdGC0LLQsCwg0J_Rg9C_0LLRgdC60LjQuSDQoNC-0YHRgiDQvtGC0Y7QuSDQv9GA0LXQudGB0LrQsNGPINGD0LvQvtCz0L4g0KfQtdGA0LXQtNC-0LLRgdC60LjQuSDRg9C70Y7RgdGC0LLQsCwg0J7RgNC_0YHQvdC40Lkg0L7QsdC10YDRgdC60LjQuSDQv9GA0LXQudGB0LrQsNGPINGD0LvQvtCz0L4!5e0!3m2!1ssr!2srs!4v1646885546216!5m2!1ssr!2srs" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                    </div>
                </div>
            </div>

            <!-- Contact Form Block -->
            <div class="col-xl-6 message-part" style="padding-top: 50px; color:white;">
                <div class="row g-4">
                    <div class="col-6 mb-3">
                        <label for="fname" class="form-label">Fname</label>
                        <input type="text" class="form-control" id="fname" placeholder="Luisa">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="Lname" class="form-label">Lname</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Klark">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Gmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Gmail" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="Phone-num" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="Phone-num" placeholder="+1234567890">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                </div>
                <button type="button" class="btn btn-dark">Send Message</button>
            </div>

        </div>
    </div>

</div>
</div>

<!-- promotion  -->
<?php
include "promotion.php";
?>

<!-- footer -->
<?php
include "footer.php";
?>