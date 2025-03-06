<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
    ],
    'recaptcha' => [
        'site_key' => $_ENV['RECAPTCHA_SITE_KEY'],
        'secret_key' => $_ENV['RECAPTCHA_SECRET_KEY'],
    ],
    'smtp' => [
        'host' => $_ENV['SMTP_HOST'],
        'port' => $_ENV['SMTP_PORT'],
        'username' => $_ENV['SMTP_USER'],
        'password' => $_ENV['SMTP_PASS'],
        'encryption' => $_ENV['SMTP_ENCRYPTION'],
    ],
];
