<?php include('../includes/header.php'); ?>

<div class='container'>
    <h3>Register</h3>
    <form action="../controllers/registerController.php" method="post">
        <div class="form-group">
            <input type="text" name="$firstName" class="form-control" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="$lastName" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <input type="date" name="birthday" class="form-control" placeholder="Date of Birth" required>
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <input type="button" class="btn btn-primary" value="Back To Login" onclick="location.href='login.php'">

    </form>
</div>

<?php include('../includes/footer.php'); ?>


