<?php
include('../includes/config.php');
global $pdo;

function login($user, $password): void
{
    global $pdo;

    $salt = $user['salt'];
    $passwordHash = $user['password_hash'];

    if(password_verify($salt . $password, $passwordHash)){
        $loginCount = $user['login_count'] + 1;

        echo "\"Hi, {$user['first_name']} {$user['last_name']}\", \"You have logged in {$loginCount} times\" and \"Last login date: {$user['last_login']}\"";

        $updateStmt = $pdo->prepare("UPDATE users SET login_count = login_count + 1, last_login = now(), login_attemps = 0 WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
    } else {
        $updateStmt = $pdo->prepare("UPDATE users SET login_attemps = login_attemps + 1, last_login = now() WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
        echo "<br>" . "Invalid credentials";
    }
}

function timeout($user, $username) {
    global $pdo;

    if($user['login_attemps'] > 3) {
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


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username
    if (!preg_match('/^[a-zA-Z0-9]{7,50}$/', $username)) {
        $errArray['username'] = "Username invalid";
    }else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if($user){

            if(timeout($user, $username)) {
                echo "Time out for 5 minutes";
                return;
            } else {
                login($user, $password);
            }
        } else {
            echo "User not found";
        }
    }
}