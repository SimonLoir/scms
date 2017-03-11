<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>S CMS</title>
    <link rel="stylesheet" href="scms-theme/theme.css">
</head>
<body>
    <div class="scms-header">
        <img src="" alt="" class="scms-header-logo">
        <span class="scms-header-title">S CMS</span>
        <div class="scms-header-actions">
            <a href="?p=home" class="scms-header-actions-link">Home</a>
            <a href="?p=news" class="scms-header-actions-link">News</a>
            <a href="?p=pricing" class="scms-header-actions-link">Pricing</a>
        </div>
    </div>
    <div class="scms-content-container">
       <?php
            if (isset($_GET["p"])) {
                $page_global = $_GET["p"];
            }else{
                $page_global = "home";
            }
            include "scms-core/page-loader.php";
       ?>
    </div>
</body>
</html>