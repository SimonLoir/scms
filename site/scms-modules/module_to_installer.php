<?php
session_start();
/*
Verifying if the admin is connected
*/
if(!isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    header('Location: ../scms-admin/login.php');
}

$sdir = scandir(".");
    unset($sdir[0]);
    unset($sdir[1]);

    foreach ($sdir as $d) {
        if(is_dir($d)){
            update($d);
        }
    }

function update($mod){
    $dir = $mod;
    $sdir = scandir($dir);
    unset($sdir[0]);
    unset($sdir[1]);

    include "../scms-version.php";

    $end_file = "@doctype installation-config-file\n";
    $end_file .= "@require *\n";
    $end_file .= "@require version $version\n";
    $end_file .= "@folder " . $dir . "\n";

    foreach ($sdir as $inside) {
        $inside = $dir. "/" . $inside;
        if(is_file($inside)){
            $end_file .= "@file~write " . $inside . "\n";
            $end_file .= file_get_contents($inside) . "\n";
            $end_file .= "@file~close " . $inside . "\n";
        }else{

            $end_file .= getFolderContent($inside);
        }
    }

    file_put_contents($dir . ".config", $end_file);
}

function getFolderContent($i){
        $end_file = "@folder " . $i . "\n";
        $d = scandir($i);
        unset($d[0]);
        unset($d[1]);
        foreach ($d as $inside) {
            $inside = $i. "/" . $inside;    
            if(is_file($inside)){
                $end_file .= "@file~write " . $inside . "\n";
                $end_file .= file_get_contents($inside) . "\n";
                $end_file .= "@file~close " . $inside . "\n";
            }else{
                $end_file .= getFolderContent($inside);
            }
        }
        return $end_file;
}
?>