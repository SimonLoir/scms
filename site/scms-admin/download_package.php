<?php
header("Access-Control-Allow-Origin: *");
session_start();

if(!isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    exit('Sorry, you don\'t have the right permissions in order to install an app.');
}

if(isset($_POST["data"]) && isset($_POST["package"])){
    if(!is_dir("../scms-modules")){
        var_dump(scandir("../"));
        exit('config error');
    }
    if(file_put_contents('../scms-modules/' . $_POST["package"] . ".config", $_POST["data"])){

        header('Location: index.php?p=store');
        exit('ok'); 
    }else{
        exit('erreur : impossible de sauvegarder les données ' . '../scms-modules/' . $_POST["package"] . ".config". $_POST["data"]);
    }
}else{
    exit('error : resquest is incorrect');
}



?>