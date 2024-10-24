<?php
include('../includes/config.php');
global $pdo;

function login($user, $password): void
{
    global $pdo;

    $salt = $user['salt'];
    $passwordHash = $user['password_hash'];

    if(password_verify($salt . $password, $passwordHash)){
        session_start();

        session_regenerate_id();

        $_SESSION["user_id"] = $user["idusers"];

        header("Location: ../views/index.php");
        exit;

    } else {
        $updateStmt = $pdo->prepare("UPDATE users SET login_attemps = login_attemps + 1, last_login = now() WHERE idusers = ?");
        $updateStmt->execute([$user['idusers']]);
        echo "<div class=\"container\"><p>Invalid Credentials</p><form action='../views/login.php' method='get'><div class=\"form-group\">
                <button type='submit' name='submit' class=\"btn btn-primary\">Go Back to login</button></div>
              </form></div>";
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


if(isset($_POST['login_submit'])){
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
            echo "<p>Invalid Credentials</p><form action='../views/login.php' method='get'>
                <button type='submit' name='submit' class='btn btn-primary'>Go Back to login</button>
              </form>";
        }
    }

}