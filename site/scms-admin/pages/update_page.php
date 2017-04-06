<?php
session_start();

$json = urldecode($_POST["page_json"]);

if(!isset($_SESSION["scms-global-admin"])){
    echo "Forbidden area";
}

if(file_put_contents("../../scms-pages/" . $_GET["p"] . ".json", $json)){
    exit("Ok");
}else{
    exit('error');
}
?>