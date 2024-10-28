

const register_form = document.getElementById("register_form");
if(register_form) {
    const firstName = document.getElementById("firstName");
    const lastName = document.getElementById("lastName");
    const birthday = document.getElementById("birthday")
    const username = document.getElementById("username")
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const password_confirmation = document.getElementById("password_confirmation");

    const firstName_error = document.getElementById("firstName_error");
    const lastName_error = document.getElementById("lastName_error");
    const birthday_error = document.getElementById("birthday_error");
    const username_error = document.getElementById("username_error")
    const email_error = document.getElementById("email_error");
    const password_error = document.getElementById("password_error");
    const password_confirmation_error = document.getElementById("password_confirmation_error");

    register_form.addEventListener('submit', (e) => {

        const email_check = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([A-Za-z]{2,})$/;

        firstName_error.innerHTML = "";
        lastName_error.innerHTML = "";
        username_error.innerHTML = "";
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

        if(birthday.value === "" || birthday.value == null)
        {
            e.preventDefault();
            birthday_error.innerHTML = "Birthday is required";
        }

        if(username.value === "" || username.value == null) {
            e.preventDefault();
            username_error.innerHTML = "Username is required";
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
        const letter_check = /[a-zA-Z]/; // Regular expression for letters
        const number_check = /[0-9]/; // Regular expression for numbers

        if (!letter_check.test(password.value) || !number_check.test(password.value)) {
            e.preventDefault();
            password_error.innerHTML = "Password must contain at least one letter and one number";
        }

        if(password_confirmation.value === "" || password_confirmation.value == null) {
            e.preventDefault();
            password_confirmation_error.innerHTML = "Password confirmation required";
        }

        // Validate password confirmation
        if (password.value !== password_confirmation.value) {
            e.preventDefault();
            password_confirmation_error.innerHTML = "Passwords do not match";
        }
    })
}

const login_form = document.getElementById("login_form");
if(login_form) {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const username_error = document.getElementById("username_error");
    const password_error = document.getElementById("password_error");

    login_form.addEventListener('submit', (e) => {

        username_error.innerHTML = "";
        password_error.innerHTML = "";

        let valid = true;

        if(username.value === "" || username.value == null) {
            e.preventDefault();
            username_error.innerHTML = "Username is required";
        }

        if(password.value === "" || password.value == null) {
            e.preventDefault();
            password_error.innerHTML = "Password is required";
        }

        // Check reCAPTCHA validation
        const response = grecaptcha.getResponse();
        if (response.length == 0) {
            e.preventDefault();
            alert("Please verify you are not a robot.");
            valid = false;
        }

        // Only proceed if all validations are successful
        if (!valid) {
            e.preventDefault();
        }

    })

}

const reset_password_form = document.getElementById("reset_password_form");

if(reset_password_form) {

    const password = document.getElementById("password");
    const password_confirmation = document.getElementById("password_confirmation");
    const password_error = document.getElementById("password_error");
    const password_confirmation_error = document.getElementById("password_confirmation_error");

    reset_password_form.addEventListener('submit', (e) => {

        password_error.innerHTML = "";
        password_confirmation_error.innerHTML = "";

        if(password.value.length < 8)
        {
            e.preventDefault();
            password_error.innerHTML = "Password must more than 8 characters";
        }

        // Validate password contains at least one letter and one number
        const letter_check = /[a-zA-Z]/; // Regular expression for letters
        const number_check = /[0-9]/; // Regular expression for numbers

        if (!letter_check.test(password.value) || !number_check.test(password.value)) {
            e.preventDefault();
            password_error.innerHTML = "Password must contain at least one letter and one number";
        }

        if(password_confirmation.value === "" || password_confirmation.value == null) {
            e.preventDefault();
            password_confirmation_error.innerHTML = "Password confirmation required";
        }

        // Validate password confirmation
        if (password.value !== password_confirmation.value) {
            e.preventDefault();
            password_confirmation_error.innerHTML = "Passwords do not match";
        }

    })

}


