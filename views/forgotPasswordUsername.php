<?php include('../includes/header.php'); ?>

<div class='container'>
    <h3 style="text-align: center">Forgot Username/Password</h3>
    <form action="../controllers/forgotController.php" method="post" id="forgot_form">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="email" id="email">
            <span id="email_error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Send Email</button>
        <input type="button" class="btn btn-primary" value="Back To Login" onclick="location.href='login.php'">
    </form>
</div>



<?php include('../includes/footer.php'); ?>
