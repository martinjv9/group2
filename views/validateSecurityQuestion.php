<?php
include("../config/config.php");
global $pdo;

$showQuestion = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && empty($_POST['showQuestion'])) {
        // Step 1: Handle email input to fetch the security question
        $email = $_POST['email'];

        // Fetch user by email
        $stmt = $pdo->prepare("SELECT security_question FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $showQuestion = true;
            $security_question = $user['security_question'];
        } else {
            $error = "Email not found.";
        }
    } elseif (isset($_POST['security_answer']) && isset($_POST['email']) && isset($_POST['showQuestion'])) {
        // Step 2: Handle security question answer
        $email = $_POST['email'];
        $security_answer = $_POST['security_answer'];

        // Fetch user and verify security answer
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($security_answer, $user['security_answer_hash'])) {
            // Generate reset token
            $token = bin2hex(random_bytes(16));
            $token_hash = hash('sha256', $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            // Update token in the database
            $updateStmt = $pdo->prepare("UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?");
            $updateStmt->execute([$token_hash, $expiry, $email]);

            // Redirect to reset password page
            header("Location: resetPassword.php?token=$token");
            exit;
        } else {
            $error = "Invalid security answer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class='container'>
    <h3>Answer Security Question</h3>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="validateSecurityQuestion.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" <?php echo $showQuestion ? 'readonly' : '' ?> required>
        </div>
        <?php if ($showQuestion): ?>
            <div class="form-group">
                <label for="security_question">Security Question</label>
                <input type="text" name="security_question" class="form-control" value="<?php echo htmlspecialchars($security_question); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="security_answer">Answer</label>
                <input type="text" name="security_answer" class="form-control" required>
            </div>
            <!-- Hidden input to persist $showQuestion state -->
            <input type="hidden" name="showQuestion" value="1">
        <?php endif; ?>
        <button type="submit" class="btn btn-primary"><?php echo $showQuestion ? "Submit Answer" : "Next"; ?></button>
    </form>
</div>
</body>
</html>
