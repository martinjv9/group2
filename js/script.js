// Password strength validation
const passwordField = document.getElementById("password");
const passwordStrengthIndicator = document.getElementById("password_strength");

if (passwordField) {
    passwordField.addEventListener("input", () => {
        const value = passwordField.value;
        const strength = evaluatePasswordStrength(value);
        passwordStrengthIndicator.innerHTML = strength.message;
        passwordStrengthIndicator.style.color = strength.color;
    });
}

/**
 * Evaluates password strength based on complexity.
 * @param {string} password - The password to evaluate.
 * @returns {Object} - An object containing a strength message and corresponding color.
 */
function evaluatePasswordStrength(password) {
    // Strength levels regex
    const weakRegex = /^[a-zA-Z0-9]{1,7}$/; // Weak: Less than 8 characters, simple
    const mediumRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{8,15}$/; // Medium: Letters and numbers, 8-15 chars
    const specialChars = "!@#$%^&*-_=+.'\"{}`~";
    const strongRegex = new RegExp(`^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[${specialChars}])[a-zA-Z0-9${specialChars}]{8,}$`);

    // Check the password against the regexes
    if (strongRegex.test(password)) {
        return { message: "Strong password", color: "green" };
    } else if (mediumRegex.test(password)) {
        return { message: "Medium strength password", color: "orange" };
    } else if (password.length > 0) {
        return { message: "Weak password", color: "red" };
    } else {
        return { message: "", color: "" };
    }
}

const register_form = document.getElementById("register_form");
if(register_form) {
    const firstName = document.getElementById("firstName");
    const lastName = document.getElementById("lastName");
    const birthday = document.getElementById("birthday")
    const username = document.getElementById("username")
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const password_confirmation = document.getElementById("password_confirmation");
    const security_question = document.getElementById("security_question");
    const security_answer = document.getElementById("security_answer");

    const firstName_error = document.getElementById("firstName_error");
    const lastName_error = document.getElementById("lastName_error");
    const birthday_error = document.getElementById("birthday_error");
    const username_error = document.getElementById("username_error")
    const email_error = document.getElementById("email_error");
    const password_error = document.getElementById("password_error");
    const password_confirmation_error = document.getElementById("password_confirmation_error");
    const security_question_error = document.getElementById("security_question_error");
    const security_answer_error = document.getElementById("security_answer_error");

    register_form.addEventListener('submit', (e) => {

        const email_check = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([A-Za-z]{2,})$/;

        firstName_error.innerHTML = "";
        lastName_error.innerHTML = "";
        username_error.innerHTML = "";
        email_error.innerHTML = "";
        password_error.innerHTML = "";
        password_confirmation_error.innerHTML = "";
        security_question_error.innerHTML = "";
        security_answer_error.innerHTML = "";


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

        if (password.value.length < 8) {
            e.preventDefault();
            password_error.innerHTML = "Password must be at least 8 characters long";
        }

        const letter_check = /[a-zA-Z]/;
        const number_check = /[0-9]/;

        if (!letter_check.test(password.value) || !number_check.test(password.value)) {
            e.preventDefault();
            //password_error.innerHTML = "Password must contain at least one letter and one number";
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

        if (security_question.value === "") {
            e.preventDefault();
            security_question_error.innerHTML = "Please select a security question.";
        }

        if (security_answer.value.trim() === "") {
            e.preventDefault();
            security_answer_error.innerHTML = "Answer to the security question is required.";
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


