<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password/Username</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script defer src="../js/script.js"></script>
</head>
<body>


<div class='container'>
    <h3 style="text-align: center">Forgot Username/Password</h3>
    <form action="../controllers/sendPasswordReset.php" method="post" id="forgot_form">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="email" id="email">
            <span id="email_error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <a href="../views/login.php">Back to login</a>
</div>



<?php include('../includes/footer.php'); ?>
