<?php
include "navigation.php";
session_start();
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
                                        <span>+0123456789</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="aos-item" data-aos="fade-up" data-aos-delay="800">
                            <div class="mt-4 w-100 aos-item__inner">
                                <iframe class="hvr-shadow" width="100%" height="345" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2795.6323612760217!2d19.67368451569028!3d46.09745307911407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47672e6f4bdc5d55%3A0xe86a901e5852ad28!2z0JHRg9C70L7RgdGC0LLQsCwg0J_Rg9C_0LLRgdC60LjQuSDQoNC-0YHRgiDQvtGC0Y7QuSDQv9GA0LXQudGB0LrQsNGPINGD0LvQvtCz0L4g0KfQtdGA0LXQtNC-0LLRgdC60LjQuSDRg9C70Y7RgdGC0LLQsCwg0J7RgNC_0YHQvdC40Lkg0L7QsdC10YDRgdC60LjQuSDQv9GA0LXQudGB0LrQsNGPINGD0LvQvtCz0L4!5e0!3m2!1ssr!2srs!4v1646885546216!5m2!1ssr!2srs" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                            </div>
                        </div>
                    </div>

                    <!-- Contact Form Block -->
                    <div class="col-xl-6 message-part" style="padding-top: 50px; color:white;">
                        <form action="contact_us.php" method="post" id='contactForm'>
                            <div class="mb-3"><small style="color: #ff0000"></small>
                                <select id="type" name="type" required>
                                    <option value="-1">Choose reason for contacting</option>
                                    <option value="violation">Violation (stalking, contacting after the job is done, insulting...)</option>
                                    <option value="falseAccount">Fake account</option>
                                    <option value="somethingWrong">Something is wrong with my account</option>
                                </select>
                            </div>
                            <div class="row g-4">
                                <div class="col-6 mb-3">
                                    <label for="fname" class="form-label">Fname</label>
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Luisa">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="Lname" class="form-label">Lname</label>
                                    <input type="text" class="form-control" id="Lname" name="Lname" placeholder="Klark">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Gmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Gmail" name="Gmail" placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="Phone-num" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="Phone-num" name="Phone-num" placeholder="+1234567890">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="exampleFormControlTextarea1" rows="6" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        window.addEventListener("DOMContentLoaded", init);

        function init() {
            const form = document.getElementById('contactForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                let isValid = validateForm();

                if (isValid) {
                    alert('Mail has been sent');
                    sendData();
                    window.location.href = 'contact.php';
                }
            });
        }
        function validateForm() {
            let isValid = true;
            const comType = document.getElementById('type');
            if(comType.value == '-1')
            {
                const formField = comType.parentElement;
                formField.classList.add('error');

                const error = formField.querySelector('small');
                error.innerText = 'Please select a type of complaint';
                isValid = false;
            }
            else{
                const formField = comType.parentElement;
                formField.classList.remove('error');
                const error = formField.querySelector('small');
                error.innerText = "";
            }
            return isValid;
        }

        function sendData(){
            const fname = document.getElementById('fname');
            const Lname = document.getElementById('Lname');
            const phone = document.getElementById('Phone-num');
            const message = document.getElementById('exampleFormControlTextarea1');
            const comType = document.getElementById('type');
            const Gmail = document.getElementById('Gmail');

            const resultDiv = document.getElementById('result');

            let request = new XMLHttpRequest();
            let url = "contact.php";

            request.open("POST", url, true);
            request.setRequestHeader("Content-Type", "application/json");
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    let jsonData = JSON.parse(request.response);
                    resultDiv.innerHTML = jsonData.message;
                }
            };

            let data = JSON.stringify({
                "fname": fname.value,
                "Lname": Lname.value,
                "Phone-num": parseInt(phone.value),
                "exampleFormControlTextarea1": message.value,
                "type": comType.value,
                "Gmail": Gmail.value
            });

            request.send(data);
        }
    </script>
    <!-- promotion  -->
<?php
include "promotion.php";
?>

    <!-- footer -->
<?php
include "footer.php";
?>