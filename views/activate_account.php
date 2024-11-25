<?php
global $pdo;

// Grab activation token from url
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

include("../includes/config.php");

// Grab user based on token hash
$stmt = $pdo->prepare("SELECT * FROM users WHERE account_activation_hash = ?");
$stmt->execute([$token_hash]);
$user = $stmt->fetch();

// Check if user exist
if($user == NULL) {
    die("Token doesn't exist");
}

// Make activation token hash to null to represent user is active.
$updateStmt = $pdo->prepare("UPDATE users SET account_activation_hash = NULL WHERE idusers = ?");
$updateStmt->execute([$user["idusers"]]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activated</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script defer src="../js/script.js"></script>
</head>
<body>

<div class='container'>
    <h3 style="text-align: center">Account Activated</h3>
    <p>Account activated successfully. You can now <a href="login.php">Log in</a></p>
</div>
</body>
</html>