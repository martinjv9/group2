<?php
require_once '../includes/session.php';
$config = include('../config/config.php');

global $pdo;

function login($user, $password): void
{
    global $pdo;

    $passwordHash = $user['password_hash'];

    if(password_verify($password, $passwordHash)){
        
        session_regenerate_id(true); // Secure session ID after login

        $_SESSION["user_id"] = $user["idusers"];

        // Generate a one-time code
        $mfa_code = rand(100000, 999999);
        $_SESSION["mfa_pending"] = true;
        $_SESSION["mfa_code"] = $mfa_code;
        $_SESSION["mfa_code_expiry"] = time() + 300;

        // Send the code via email
        $email = $user['email'];
        sendMfaCode($email, $mfa_code);

        // Redirect to MFA verification page
        header("Location: ../views/mfa_verify.php");
        exit;

    } else {
        $updateStmt = $pdo->prepare("UPDATE users SET login_attemps = login_attemps + 1, last_login = now() WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
        echo "<div class=\"container\"><p>Invalid Credentials</p><form action='../views/login.php' method='get'><div class=\"form-group\">
                <button type='submit' name='submit' class=\"btn btn-primary\">Go Back to login</button></div>
              </form></div>";
    }
}

function sendMfaCode($email, $mfa_code): void
{
    include("../utilities/mailer.php");

    $mail = include("../utilities/mailer.php");
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Your One-Time Code";

    $mail->Body = "Your one-time code is: $mfa_code";

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit;
    }
}

function timeout($user, $username) {
    global $pdo;

    if($user['login_attemps'] > 2) {
        date_default_timezone_set('America/Los_Angeles');
        $current_time = time();
        $stmt = $pdo->prepare("SELECT last_login FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $last_login = $stmt->fetchColumn();

        if($last_login){
            $last_login_unix = strtotime($last_login);

            if($last_login_unix === false) {
                echo "Error parsing last login time.";
            } else {
                $time_difference = $current_time - $last_login_unix;

                if($time_difference < 300) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }  else {
        return false;
    }

}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token mismatch!");
    }
    

    $username = $_POST['username'];
    $password = $_POST['password'];
    $errArray = [];
    
    // Validate username
    if (!preg_match('/^[a-zA-Z0-9]{7,50}$/', $username)) {
        $errArray['username'] = "Username invalid";
    }else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if($user && $user["account_activation_hash"] === null){
            if(timeout($user, $username)) {
                echo "Time out for 5 minutes";
                return;
            } else {
                login($user, $password);
            }
        } else {
            echo "<p>Invalid Credentials</p><form action='../views/login.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to login</button>
              </form>";
            die();
        }
    }
    echo "<p>Invalid Credentials</p><form action='../views/login.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to login</button>
              </form>";

}