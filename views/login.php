<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script defer src="../js/script.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<div class='container'>
    <h3 style="text-align: center">Login</h3>
    <form action="../controllers/loginController.php" method="post" id="login_form">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" id="username">
            <span id="username_error"></span>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            <span id="password_error"></span>
        </div>
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcUtm4qAAAAAIK6S7BLOhaLEXqdF44WZdmwh010"></div>
        </div>
        <button type="submit" class="btn btn-primary" name="login_submit">Login</button>
        <input type="button" id="login" class="btn btn-primary" value="New User? Sign Up" onclick="location.href='register.php'">
    </form>
    <a href="../views/validateSecurityQuestion.php">Forgot Username or Password?</a>
</div>

<?php include('../includes/footer.php'); ?>
