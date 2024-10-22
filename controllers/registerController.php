<?php

$isValid = true;
$errArray = array();

while($isValid){
    if(isset($_POST['submit'])){
        $firstName = $_POST['$firstName'];
        $firstNameErr = "";
        if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
            $isValid = false;
            $errArray[0] = "first_name";
            $firstNameErr = "Only letters and white space allowed";
        }

        $lastName = $_POST['lastName'];
        $lastNameErr = "";
        if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
            $isValid = false;
            $errArray[1] = "lastName";
            $lastNameErr = "Only letters and white space allowed";
        }

        $birthday = $_POST['birthday'];

        $email = $_POST['email'];
        $emailErr = "";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $errArray[2] = "email";
            $emailErr = "Invalid email format";
        }

        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        # Stop process if passwords don't match
        if($password != $confirmPassword){
            $isValid = false;
            $errArray[3] = "password";
            echo ("Passwords do not match");
        }
    }
}
