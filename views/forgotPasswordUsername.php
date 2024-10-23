<?php include('../includes/header.php'); ?>

<div class='container'>
    <h3 style="text-align: center">Forgot Username/Password</h3>
    <form action="../controllers/forgotController.php" method="post">
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
        <input type="button" class="btn btn-primary" value="Back To Login" onclick="location.href='login.php'">

    </form>
</div>



<?php include('../includes/footer.php'); ?>
