<?php
include("../config/config.php");
global $pdo;

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash('sha256', $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$updateStmt = $pdo->prepare("UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?");
$updateStmt->execute([$token_hash, $expiry, $email]);

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if($updateStmt->rowCount() == 1){
    $mail = include("../utilities/mailer.php");


    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Reset Password";

    $mail->Body = <<<END
    Click <a href=http://localhost:63342/group2/views/resetPassword.php?token=$token>here</a> to reset your password.<br>
    Username: $user[username]
    END;

    try {
        $mail->send();
    }catch (Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

echo "Message sent, please check your inbox.";