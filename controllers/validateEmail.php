<?php
include('../config/config.php');
require_once '../includes/session.php';

global $pdo;

// Sanitize and validate email
$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["error" => "Invalid email format"]);
    exit;
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$is_available = $stmt->fetchColumn() > 0;

header("Content-type: application/json");
echo json_encode(["available" => !$is_available]);
