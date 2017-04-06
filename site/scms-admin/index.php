<?php
session_start();

if(!isset($_SESSION["scms-global-admin"])){
    header('Location: login.php');
}

$ic = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../scms-theme/style-admin-panel.css">
    <script src="../scms-core/extjs.js"></script>
    <style>a{text-decoration: none;cursor:pointer;}& a button{cursor:pointer;}</style>
</head>
<body>
    <div class="main-panel">
        <div class="header">
            SCMS admin panel version 1.0.1 alpha
        </div>
        <div class="left-panel">
            <button><b style="font-size:20px;">menu</b></button>
            <a href="?p=home"><button id="home">Home</button></a>
            <a href="?p=pages"><button id="pages">Pages</button></a>
            <a href="?p=admin-actions"><button id="admin-actions">Super admins</button></a>
            
            <span>&copy; 2017 - Simon Loir</span>
        </div>
        <div class="content-panel">
            
            <?php
            if(isset($_GET["p"])){
                $page = $_GET["p"];
            }else{
                $page = "home";
            }
            if(is_file("pages/" . $page .".php")){
                include "pages/" . $page .".php";
            }else{
                echo "x-fatal-error";
            }

            ?>

        </div>
    </div>
</body>
</html>
