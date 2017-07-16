<?php
session_start();

if(isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Me connecter</title>
    <style>
        body{
            background:#f9f9f9;
            font-family: sans-serif;
        }

        .login-form{
            background:white;
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
            color:rgba(0,0,0,0.75);
        }

        input[type="text"], input[type="password"]{
            margin: 0;padding: 0;
            width: calc(100% - 15px);
            border:none;
            background:#f8f8f8;
            padding: 5px;
            margin-top: 8px;
            margin-bottom: 12px;
        }

        h2{
            text-align:center;
            margin-bottom: 25px;
            color:cornflowerblue;
        }

        input[type="submit"]{

            color:white;
            background:cornflowerblue;
            border:none;
            padding: 8px;
            float: right;
            
        }
        .login-form div{
            height: 25px;
            margin: 5px;
            margin-top: 12px;
        }

        .error-message{
            color:crimson;
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

        if($_POST["uname"] != $user_name){
            $result = "Bad username<br /><br />";
        }

         
        if(password_verify($_POST["upsswd"], $user_password) && !$result){
            
            $_SESSION["scms-global-admin-" . sha1(realpath("../."))] = $user_name;
            if(isset($_SESSION["first_use"])){
                header('Location: ../scms-modules/install.php?redir=../scms-admin/?p=home');
                exit("");
            }
            file_put_contents("login.log", file_get_contents('login.log') . "\n Connexion réussie par " . $_SERVER["REMOTE_ADDR"] . " le " . $date->format('Y-m-d H:i:s') );
            header('Location: index.php');
            exit('');
        }else{
            $result = "Bad password<br /><br />";
         }
        file_put_contents("login.log", file_get_contents('login.log') . "\n Echec de la connexion. Tentative de connexion par " . $_SERVER["REMOTE_ADDR"] . " le " . $date->format('Y-m-d H:i:s') );

    }

    ?>
    <div class="login-form">
        <form action="" method="post">

            <h2>Me connecter</h2>

            <span class="error-message">
                <?= $result ?>
            </span>
            <label for="username">Username</label>
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