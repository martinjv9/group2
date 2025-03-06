<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include("../vendor/autoload.php");
$config = include('/var/www/config.php');


$mail = new PHPMailer(true);

//$mail->SMTPDebug = 2; // Shows connection issues in detail
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = $config['smtp']['host'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = $config['smtp']['port'];
$mail->Username = $config['smtp']['username'];
$mail->Password = $config['smtp']['password'];

$mail->isHTML(true);

return $mail;

