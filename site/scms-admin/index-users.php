<?php
session_start();
if(!isset($_SESSION["scms-admin-user" . sha1(realpath("../."))]) && !isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    header('Location: login-users.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../scms-theme/style-admin-panel.css">
    <script src="../scms-core/extjs.js"></script>
    <style>a{text-decoration: none;cursor:pointer;} a button{cursor:pointer;}</style>
</head>
<body>
    <div class="main-panel">
        <div class="header">
            Applications du site web
        </div>
        <div class="left-panel">
            <button><b style="font-size:20px;">menu</b></button>
            <a href="?p=home"><button id="home">Home</button></a>
            <a href="index.php"><button id="menu_links">Admin</button></a>
            <a href="logout.php"><button id="logout">Me déconnecter</button></a>
            
            <span>&copy; 2017 - Simon Loir</span>
        </div>
        <div class="content-panel">
            
        </div>
    </div>
</body>
</html>