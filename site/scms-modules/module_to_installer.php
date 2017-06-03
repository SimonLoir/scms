<?php
session_start();
/*
Verifying if the admin is connected
*/
if(!isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    header('Location: ../scms-admin/login.php');
}
/*
If the module exists
*/
if(!isset($_GET['mod']) || !is_dir($_GET['mod'])){
    exit('Please specify a module');
}

$dir = $_GET["mod"];
$sdir = scandir($dir);
unset($sdir[0]);
unset($sdir[1]);

var_dump($sdir);

$end_file = "@doctype installation-config-file\n";

foreach ($sdir as $inside) {
    if(is_file($dir. "/" . $inside)){
        $inside = $dir. "/" . $inside;
        $end_file .= "@file~write " . $inside . "\n";
        $end_file .= file_get_contents($inside) . "\n";
        $end_file .= "@file~close " . $inside . "\n";
    }else{

    }
}

file_put_contents($dir . ".config", $end_file);
?>