<?php

if(!isset($_POST["user"])){
    exit('Credential error : invalid username');
}

if(!isset($_POST["password"])){
    exit('Credential error : invalid password');
}

?>