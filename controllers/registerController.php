<?php
global $conn, $pdo;
include('../includes/header.php');
include('../includes/config.php');

$isValid = true;
$errArray = array(); // To store error messages

if(isset($_POST['submit'])){ // Check if submit button was clicked
    $firstName = $_POST['firstName'];

    // Validate first name
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
        $isValid = false;
        $errArray['firstName'] = "Only letters and white space allowed";
    }

    $lastName = $_POST['lastName'];

    // Validate last name
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
        $isValid = false;
        $errArray['lastName'] = "Only letters and white space allowed";
    }

    $birthday = $_POST['birthday'];

    $username = $_POST['username'];

    // Validate username
    if (preg_match('/^[a-zA-Z0-9]{7,50}$/', $username)) {
        echo "Username is valid.";
    } else {
        $errArray['username'] = "Username invalid";
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");

    $stmt->execute(['username' => $username]);

    $user = $stmt->fetch();

    if($user){
        $isValid = false;
        $errArray['username'] = "Username already exists";
    }

    $email = $_POST['email'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errArray['email'] = "Invalid email format";
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");

    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch();

    if($user){
        $isValid = false;
        $errArray['email'] = "Email already exists";
    }

    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirmation'];

    // Validate passwords match
    if($password != $confirmPassword){
        $isValid = false;
        $errArray['password'] = "Passwords do not match.";
    }

    if($isValid){
        $length = 16;
        $salt = bin2hex(random_bytes($length)); // Generate a random Salt
        $hashed_password = password_hash($salt . $password, PASSWORD_DEFAULT);
        // echo("password hashed");

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, birth_date, username, email, salt, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $birthday, $username, $email, $salt, $hashed_password]);


        //TODO: EMAIL VERIFICATION


        echo "<p>User registered successfully.</p><form action='../views/login.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to login</button>
              </form>";

    } else {
        foreach($errArray as $filed => $error) {
            echo "<p>Error in $filed: $error</p>";
        }
        echo "<form action='../views/register.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to Registration</button>
              </form>";
    }


}

