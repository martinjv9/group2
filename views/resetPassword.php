<?php
global $pdo;

// Grab token from url
$token = $_GET["token"];

// Hash token
$token_hash = hash("sha256", $token);

include("../includes/config.php");

// Grab user based on token bash
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token_hash = ?");
$stmt->execute([$token_hash]);
$user = $stmt->fetch();

// Check if user exists
if(!$user) {
    die("Token doesn't exist");
}

// Check if reset token has expired
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token expired");
}

//echo "token is valid and hasn't expired";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script defer src="../js/script.js"></script>
</head>
<body>

<div class='container'>
    <h3 style="text-align: center">Reset Password</h3>
    <form action="../controllers/processResetPassword.php" method="post" id="reset_password_form">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="New Password" id="password">
            <span id="password_error"></span>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password" id="password_confirmation">
            <span id="password_confirmation_error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</body>
</html>