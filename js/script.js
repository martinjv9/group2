

const form = document.getElementById("register_form");

const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const username = document.getElementById("username")
const email = document.getElementById("email");
const password = document.getElementById("password");
const password_confirmation = document.getElementById("password_confirmation");

const firstName_error = document.getElementById("firstName_error");
const lastName_error = document.getElementById("lastName_error");
const username_error = document.getElementById("username_error")
const email_error = document.getElementById("email_error");
const password_error = document.getElementById("password_error");
const password_confirmation_error = document.getElementById("password_confirmation_error");
form.addEventListener('submit', (e) => {

    var email_check = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([A-Za-z]{2,})$/;

    firstName_error.innerHTML = "";
    lastName_error.innerHTML = "";
    email_error.innerHTML = "";
    password_error.innerHTML = "";
    password_confirmation_error.innerHTML = "";

    if(firstName.value === "" || firstName.value == null)
    {
        e.preventDefault();
        firstName_error.innerHTML = "First name is required";
    }

    if(lastName.value === "" || lastName.value == null)
    {
        e.preventDefault();
        lastName_error.innerHTML = "Last name is required";
    }

    if(!email.value.match(email_check))
    {
        e.preventDefault();
        email_error.innerHTML = "Valid Email name is required";
    }

    if(password.value.length < 8)
    {
        e.preventDefault();
        password_error.innerHTML = "Password must more than 8 characters";
    }

    // Validate password contains at least one letter and one number
    var letter_check = /[a-zA-Z]/; // Regular expression for letters
    var number_check = /[0-9]/; // Regular expression for numbers

    if (!letter_check.test(password.value) || !number_check.test(password.value)) {
        e.preventDefault();
        password_error.innerHTML = "Password must contain at least one letter and one number";
    }

    // Validate password confirmation
    if (password.value !== password_confirmation.value) {
        e.preventDefault();
        password_confirmation_error.innerHTML = "Passwords do not match";
    }




})

