<?php
include('../includes/config.php');
global $pdo;
session_start();
if (isset($_SESSION["user_id"])){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE idusers = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css"
</head>
<body>
    <?php if (isset($user)){
        echo ('<p><a href="../utilities/download.php" class="btn btn-primary">Download Confidential File</a></p>');
        echo ('<p><a href="../views/logout.php" class="btn btn-primary">Log out</a></p>');
        // update login count, last login, and reset login attemps back to zero.
        $updateStmt = $pdo->prepare("UPDATE users SET login_count = login_count + 1, last_login = now(), login_attemps = 0 WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
    } else {
        echo ('<p><a href="../views/login.php" class="btn btn-primary">Login</a> or <a href="../views/register.php" class="btn btn-primary">Sign up</a></p>');
    }

    ?>



</body>
</html>
