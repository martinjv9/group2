// Initialize JustValidate
document.addEventListener("DOMContentLoaded", function() {
    const validation = new JustValidate('#register');

    validation
        .addField('#firstName', [
            {rule: 'required', errorMessage: 'First name is required'},
            {rule: 'minLength', value: 2, errorMessage: 'First name must be at least 2 characters long'},
        ])
        .addField('#lastName', [
            {rule: 'required', errorMessage: 'Last name is required'},
            {rule: 'minLength', value: 2, errorMessage: 'Last name must be at least 2 characters long'},
        ])
        .addField('#email', [
            {rule: 'required', errorMessage: 'Email is required'},
            {rule: 'email', errorMessage: 'Email is invalid'},
        ])
        .addField('#password', [
            {rule: 'required', errorMessage: 'Password is required'},
            {rule: 'password', errorMessage: 'Password is invalid'},
        ])
        .addField('#password_confirmation', [
            {
                validator: (value, fields) => {
                    return value === fields['#password'].elem.value;
                },
                errorMessage: 'Passwords must match',
            }
        ])
        .onSuccess((event) => {
            // Prevent default form submission
            event.preventDefault();

            // const submitBtn = document.createElement('input');
            // submitBtn.type = 'hidden';
            // submitBtn.name = 'submit';
            // submitBtn.value = 'submit';  // Set value for 'submit'
            //
            // // Append the hidden input to the form
            // document.getElementById('register').appendChild(submitBtn);


            // Submit the form
            document.getElementById('register').submit();  // this is better than manually calling document.getElementById()
        });
});
