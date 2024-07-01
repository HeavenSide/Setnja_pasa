// Opening a popup log in
function openLoginForm() {
    let loginForm = document.getElementById("loginFormPopup");
    let signupForm = document.getElementById("signupFormPopup");

    if (signupForm.style.display === "block") {
        closeSignupForm();
    }

    loginForm.style.display = "block";
}

// Opening a popup sign up
function openSignupForm() {
    let loginForm = document.getElementById("loginFormPopup");
    let signupForm = document.getElementById("signupFormPopup");


    if (loginForm.style.display === "block") {
        closeLoginForm();
    }

    signupForm.style.display = "block";
}
// Closing with x
function closeLoginForm() {
    let loginForm = document.getElementById("loginFormPopup");
    loginForm.style.display = "none";
}

function closeSignupForm() {
    let signupForm = document.getElementById("signupFormPopup");
    signupForm.style.display = "none";
}

// Initialization for ES Users
import { Input, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Input, Ripple });



