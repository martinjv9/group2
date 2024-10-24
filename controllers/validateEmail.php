<?php
include('../includes/config.php');
global $pdo;

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_GET['email']]);
$user = $stmt->fetch();

$is_available = $stmt->rowCount();

header("Content-type: application/json");

echo json_encode(["available" => $is_available]);



