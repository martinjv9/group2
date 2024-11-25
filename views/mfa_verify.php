<?php
session_start();

if (!isset($_SESSION["mfa_pending"]) || !$_SESSION["mfa_pending"]) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = $_POST['mfa_code'];
    $session_code = $_SESSION["mfa_code"];

    if ($user_code == $session_code) {
        if (time() > $_SESSION["mfa_code_expiry"]) {
            $error = "The one-time code has expired. Please log in again.";
            header("Location: login.php");
            exit;
        }
        echo "Code verified successfully. Redirecting to index.php...";

        session_regenerate_id(true);
        unset($_SESSION["mfa_pending"]);
        unset($_SESSION["mfa_code"]);

        // Ensure user_id remains set
        $_SESSION["user_id"] = $_SESSION["user_id"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify MFA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class='container'>
    <h3>Multi-Factor Authentication</h3>
    <p>Please enter the one-time code sent to your email.</p>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="mfa_verify.php" method="post">
        <div class="form-group">
            <input type="text" name="mfa_code" class="form-control" placeholder="Enter Code" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div>
</body>
</html>
