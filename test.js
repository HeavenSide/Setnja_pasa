window.addEventListener("DOMContentLoaded", init);

function init() {
    const form = document.getElementById('signingUpForm');

    form.addEventListener('submit', function(event) {
        let isValid = validateForm();

        if (isValid) {
            sendData();
        } else {
            event.preventDefault();
        }
    });
}

function validateForm() {
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const address = document.getElementById('address');
    const city = document.getElementById('city');
    const country = document.getElementById('country');
    const userType = document.getElementById('userType');
    let isValid = true;

    if (userType.value === 'premium') {
        const image = document.getElementById('image');

        if (!image.files.length) {
            showErrorMessage(image, 'Please upload a picture');
            isValid = false;
        } else if (image.files[0].type !== 'image/jpeg') {
            showErrorMessage(image, 'Please select a JPEG file');
            isValid = false;
        } else {
            hideErrorMessage(image);
        }
    }

    if (firstName.value.trim() === '') {
        showErrorMessage(firstName, 'Please enter your name');
        isValid = false;
    } else if (firstName.value.length > 25) {
        showErrorMessage(firstName, 'Name must be shorter than 25 characters!');
        isValid = false;
    } else {
        hideErrorMessage(firstName);
    }

    if (lastName.value.trim() === '') {
        showErrorMessage(lastName, 'Please enter your last name');
        isValid = false;
    } else if (lastName.value.length > 25) {
        showErrorMessage(lastName, 'Last name must be shorter than 25 characters!');
        isValid = false;
    } else {
        hideErrorMessage(lastName);
    }

    if (email.value.trim() === '') {
        showErrorMessage(email, 'Please enter your email');
        isValid = false;
    } else if (email.value.length > 50) {
        showErrorMessage(email, 'Email must be shorter than 50 characters!');
        isValid = false;
    } else {
        hideErrorMessage(email);
    }

    if (phone.value.trim() === '') {
        showErrorMessage(phone, 'Please enter your phone number');
        isValid = false;
    } else if (!validatePhoneNumber(phone.value)) {
        showErrorMessage(phone, 'Please enter a valid phone number');
        isValid = false;
    } else {
        hideErrorMessage(phone);
    }

    if (password.value.trim() === '') {
        showErrorMessage(password, 'Please enter your password');
        isValid = false;
    } else if (password.value.length < 9) {
        showErrorMessage(password, 'Password should be at least 9 characters long');
        isValid = false;
    } else {
        hideErrorMessage(password);
    }

    if (address.value.trim() === '') {
        showErrorMessage(address, 'Please enter your address');
        isValid = false;
    } else if (address.value.length < 3) {
        showErrorMessage(address, 'Address should be more than 3 characters long');
        isValid = false;
    } else {
        hideErrorMessage(address);
    }

    if (city.value.trim() === '') {
        showErrorMessage(city, 'Please enter your city');
        isValid = false;
    } else if (city.value.length < 3) {
        showErrorMessage(city, 'City name should be more than 3 characters long');
        isValid = false;
    } else {
        hideErrorMessage(city);
    }

    if (country.value.trim() === '') {
        showErrorMessage(country, 'Please enter your country');
        isValid = false;
    } else if (country.value.length < 3) {
        showErrorMessage(country, 'Country name should be more than 3 characters long');
        isValid = false;
    } else {
        hideErrorMessage(country);
    }

    return isValid;
}

function showErrorMessage(input, message) {
    const small = input.nextElementSibling;
    small.style.display = 'inline';
    small.textContent = message;
}

function hideErrorMessage(input) {
    const small = input.nextElementSibling;
    small.style.display = 'none';
}

function validatePhoneNumber(phoneNumber) {
    const phonePattern = /^\d{6,12}$/;
    return phonePattern.test(phoneNumber);
}

function sendData() {
    const form = document.getElementById('signingUpForm');
    const formData = new FormData(form);

    fetch('sign_up_processing.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            return response.text();
        }
        throw new Error('Network response was not ok.');
    }).then(data => {
        console.log(data);
    }).catch(error => {
        console.error('There was a problem with your fetch operation:', error);
    });
}
