<?php
include('../config/config.php');
require_once '../includes/session.php';
;
global $pdo;

if (isset($_SESSION["user_id"])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE idusers = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user) {
        // Update login count
        $loginCount = $user['login_count'] + 1;

        // Create personalized file content
        $content = "Confidential Company Information\n";
        $content .= "-------------------------------\n";
        $content .= "Hi, " . $user['first_name'] . " " . $user['last_name'] . "\n";
        $content .= "You have logged in " . $loginCount . " times.\n";
        $content .= "Last login date: " . $user['last_login'] . "\n";

        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="company_confidential_file.txt"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($content));

        // Output file content
        echo $content;

        // Update login count, last login, and reset login attempts
        $updateStmt = $pdo->prepare("UPDATE users SET login_count = login_count + 1, last_login = now(), login_attempts = 0 WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);

        exit;
    }
} else {
    // Redirect to login if the user is not authenticated
    header("Location: ../views/login.php");
    exit;
}
