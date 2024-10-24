<?php
global $pdo;

$token = $_POST["token"];
$token_hash = hash("sha256", $token);
$isValid = true;

include("../includes/config.php");


$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token_hash = ?");
$stmt->execute([$token_hash]);
$user = $stmt->fetch();

if($user == NULL) {
    die("Token doesn't exist");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token expired");
}

if(strlen($_POST['password']) < 8){
    $isValid = false;
    $errArray['passwordLength'] = "Password must be at least 8 characters";
}

if(! preg_match("/[a-z]/", $_POST['password'])) {
    $isValid = false;
    $errArray['passwordChar'] = "Password must contain at least one letter";
}

if(! preg_match("/[0-9]/", $_POST['password'])) {
    $isValid = false;
    $errArray['passwordChar'] = "Password must contain at least one one number";
}
// Validate passwords match
if($_POST["password"] !== $_POST["password_confirmation"]){
    $isValid = false;
    $errArray['password'] = "Passwords do not match.";
}

if($isValid){
    $length = 16;
    $salt = bin2hex(random_bytes($length)); // Generate a random Salt
    $hashed_password = password_hash($salt . $_POST["password"], PASSWORD_DEFAULT);
    // echo("password hashed");

    $stmt = $pdo->prepare("UPDATE users SET password_hash = ?, salt = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE idusers = ?");
    $stmt->execute([$hashed_password, $salt, $user['idusers']]);

    echo "<p>Password updated. You can now login.</p><form action='../views/login.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to login</button>
              </form>";


}