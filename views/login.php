<?php include('../includes/header.php'); ?>

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
        <button type="submit" class="btn btn-primary" name="login_submit">Login</button>
        <input type="button" class="btn btn-primary" value="New User? Sign Up" onclick="location.href='register.php'">
        <input type="button" class="btn btn-primary" value="Forgot Username or Password?" onclick="location.href='forgotPasswordUsername.php'">
    </form>
</div>

<?php include('../includes/footer.php'); ?>
