<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>S CMS</title>
    <link rel="stylesheet" href="scms-theme/theme.css">
    <script src="scms-core/extjs.js"></script>
    <?php include "scms-core/scripts.js.php"; ?>
</head>
<body>
    <div class="scms-header">
        <img src="" alt="" class="scms-header-logo">
        <span class="scms-header-title">S CMS</span>
        <div class="scms-header-actions">
            <?php include "site-header.php" ?>
        </div>
    </div>
    <div class="scms-content-container">
       <?php
            if (isset($_GET["p"])){$page_global = $_GET["p"];}else{$page_global = "home";}
            include "scms-core/pg-security.php";
            include "scms-core/page-loader.php";
            include "scms-core/advertising.php";
            include "scms-core/dev-toolkit.php";
       ?>
    </div>
</body>
</html>