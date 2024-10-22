<?php include('../includes/header.php'); ?>

<div class='container'>
    <h3 style="text-align: center">Login</h3>
    <form action="../controllers/loginController.php">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <input type="button" class="btn btn-primary" value="Register" onclick="location.href='register.php'">

    </form>
</div>

<?php include('../includes/footer.php'); ?>
