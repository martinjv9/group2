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
        $loginCount = $user['login_count'] + 1;

        echo ("<p>\"Hi, {$user['first_name']} {$user['last_name']}\", \"You have logged in {$loginCount} times\" and \"Last login date: {$user['last_login']}\"</p>\n");
        echo ("<p><a href=\"../views/logout.php\">Log out</a></p>\n");

        $updateStmt = $pdo->prepare("UPDATE users SET login_count = login_count + 1, last_login = now(), login_attemps = 0 WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
    } else {
        echo ("<p><a href=\"../views/login.php\">Login</a> or <a href=\"../views/register.php\">Sign up</a></p>\n");
    }

    ?>



</body>
</html>
