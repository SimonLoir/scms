<?php
if(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true" && !isset($_SESSION["scms-global-admin"])){
    header('Location: scms-admin');
}
?>