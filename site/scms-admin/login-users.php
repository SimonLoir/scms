<?php
session_start();

if(isset($_SESSION["scms-admin-user" . sha1(realpath("../."))])){
    header('Location: index-users.php');
}

include 'config.php';
 if($config['allow_multiple_users'] != "true"){
     exit('access denied by config file');
 }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Me connecter</title>
    <style>
        body{
            background:rgb(64,64,64);
            font-family: sans-serif;
        }

        .login-form{
            background:rgb(80,80,80);
            max-width: 200px;
            padding: 30px;
            padding-top: 15px;
            width:calc(100% - 60px);
            position: fixed;
            top: 50%;
            left: 50%;
            transform:translateX(-50%) translateY(-50%);
            box-shadow: 0px 0px 8px  rgba(0, 0, 0, 0.15);
            border-radius:5px;
            color:rgb(200, 200, 200);
        }

        input[type="text"], input[type="password"]{
            margin: 0;padding: 0;
            width: calc(100% - 15px);
            border:none;
            background:rgb(200, 200, 200);
            padding: 5px;
            margin-top: 8px;
            margin-bottom: 12px;
        }

        h2{
            text-align:center;
            margin-bottom: 25px;
            color:rgb(220, 220, 220);
        }

        input[type="submit"]{

            color:white;
            background:rgb(73, 73, 73);
            border:none;
            padding: 8px;
            float: right;
            border-radius:2px;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.15);
            cursor:pointer;
        }
        .login-form div{
            height: 25px;
            margin: 5px;
            margin-top: 12px;
        }

        .error-message{
            color:red;
        }

    </style>
</head>
<body>
    <?php
    date_default_timezone_set('Europe/Brussels');
    $result = "";

    include "user-credentials.php";

    $date = new DateTime();


    if(isset($_POST["send"])){

        $result = false;

        $user_file = "users/" . $_POST["uname"] . '.php';

        if(is_file($user_file)){

            include $user_file;

             if(password_verify($_POST["upsswd"], $user_password) && !$result){
            
            $_SESSION["scms-admin-user" . sha1(realpath("../."))] = $user_name;
            
            if(isset($_SESSION["first_use"])){
                header('Location: ../scms-modules/install.php?redir=../scms-admin/?p=home');
                exit("");
            }
            file_put_contents("login.log", file_get_contents('login.log') . "\n Connexion réussie par " . $_POST["uname"] . "@" . $_SERVER["REMOTE_ADDR"] . " le " . $date->format('Y-m-d H:i:s') );
            
            header('Location: index-users.php');
            exit('');
            }
                
            file_put_contents("login.log", file_get_contents('login.log') . "\n Echec de la connexion. Tentative de connexion (user) par " . $_SERVER["REMOTE_ADDR"] . ":" . $_POST["uname"] . " le " . $date->format('Y-m-d H:i:s') );
        }else{
            $result = "Bad username or password<br /><br />";
        }
        
    }

    ?>
    <div class="login-form">
        <form action="" method="post">

            <h2>Me connecter</h2>

            <span class="error-message">
                <?= $result ?>
            </span>
            <label for="username">Email</label>
            <input type="text" name="uname">
            
            <label for="username">Password</label>
            <input type="password" name="upsswd">
            <div>
                <input type="submit" value="Continuer" name="send">
            </div>
        </form>
    </div>
</body>
</html>