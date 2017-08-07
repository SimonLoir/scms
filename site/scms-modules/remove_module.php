<?php
session_start();

if(isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){

    if(isset($_GET['module']) && is_dir($_GET['module'])){
         delete_all_r($_GET["module"]);
    }

    if(isset($_GET["gui"]) && $_GET["gui"] == "true"){

         header('Location: ../scms-admin/?p=store');

    }

}else{
    echo "Sorry, you aren't allowed to remove packages";
}

function delete_all_r($dir)
{ 
    $files = array_diff(scandir($dir), array('.', '..')); 
    foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? delete_all_r("$dir/$file") : unlink("$dir/$file"); 
    }
    return rmdir($dir); 
} 
?>