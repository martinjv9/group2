<?php include '../includes/header.php'; ?>

<div class='container'>
    <h3>Register</h3>
    <form action="../controllers/registerController.php" method="post" id="register_form">
        <div class="form-group">
            <input type="text" name="firstName" class="form-control" placeholder="First Name" id="firstName">
            <span id="firstName_error"></span>
        </div>
        <div class="form-group">
            <input type="text" name="lastName" class="form-control" placeholder="Last Name" id="lastName">
            <span id="lastName_error"></span>
        </div>
        <div class="form-group">
            <input type="date" name="birthday" class="form-control" placeholder="Date of Birth" id="birthday">
            <span id="birthday_error"></span>
        </div>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" id="username">
            <span id="username_error"></span>
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" id="email" >
            <span id="email_error"></span>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            <span id="password_error"></span>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" id="password_confirmation">
            <span id="password_confirmation_error"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="register_submit">Register</button>
        <input type="button" class="btn btn-primary" value="Back To Login" onclick="location.href='login.php'">

    </form>
</div>

<?php include('../includes/footer.php'); ?>


