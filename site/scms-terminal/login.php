<?php
/*
    session_start();

    include "../scms-admin/user-credentials.php";

    if(!isset($_POST["user"]) || !isset($_POST["password"] )){
        exit('Error');
    }

    if($_POST["user"] != $user_name){
        exit('Username error');
    }

    if(!password_verify($_POST["password"], $user_password)){
        exit('Password error');
    }

    $_SESSION["scms-global-admin-" . sha1(realpath("../."))] = $_POST["user"];

    exit('ok');
*/
?>