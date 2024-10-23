<?php include('../includes/header.php'); ?>

<div class='container'>
    <h3 style="text-align: center">Login</h3>
    <form action="../controllers/loginController.php" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
        <input type="button" class="btn btn-primary" value="New User? Sign Up" onclick="location.href='register.php'">
        <input type="button" class="btn btn-primary" value="Forgot Username or Password?" onclick="location.href='forgotPasswordUsername.php'">
    </form>
</div>

<?php include('../includes/footer.php'); ?>
