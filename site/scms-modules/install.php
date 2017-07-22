<?php
session_start();
//var_dump($_SESSION);
if(isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){
    
    if(isset($_GET["mi"])){

        $e = $_GET["mi"];

       $f = explode("|", $e);

       foreach ($f as $ff) {
           install($ff);
       }

    }else{
        $files = scandir('.');

        foreach ($files as $file) {
            if(explode(".", $file)[sizeof(explode(".", $file)) - 1] == "config"){
                try{
                    install(str_replace('.config', "", $file));
                }catch (Exception $e){
                    
                }
            }

        }
    }

    if(isset($_GET["redir"])){
        header('Location: ' . $_GET["redir"]);
        exit('');
    }

}else{
    echo ":error:";
}

function delTree($dir)
{ 
    $files = array_diff(scandir($dir), array('.', '..')); 
    foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    }
    return rmdir($dir); 
} 

function install ($mod){

        if(is_dir($mod)){
            delTree($mod);
        }

        $file = file_get_contents($mod . ".config");

        $file = explode("\n", $file);

        $wrapper = "";
        $file_name = "";

        if(trim($file[0]) != "@doctype installation-config-file"){
            echo("\n" . "Installation media - error");
            return;
        }

        for ($i=0; $i < sizeOf($file); $i++) { 

            $x = trim($file[$i]);

            if(strpos($x , "@folder ") === 0){

                $folder_name = str_replace("@folder ", "", $x);

                if(!is_dir($folder_name)){
                    mkdir($folder_name);
                }else{
                    echo("\n" . "Config_error -> config file :: folder");
                    return;
                }

            }else if(strpos($x , "@file~write ") === 0){

                $file_name = str_replace("@file~write ", "", $x);

            }else if(strpos($x , "@require version ") === 0){
                
                echo "\n";

                include "../scms-version.php";

                $v = str_replace("@require version ", "", $x);

                if($v != $version){
                    echo("\n" . 'Version error');
                    return;
                }

            }else if(strpos($x , "@file~close ") === 0){

                $filexxx = str_replace("@file~close ", "", $x);


                if($filexxx != $file_name){
                    echo("\n" . 'Config error');
                    return;
                }

                file_put_contents($filexxx, $wrapper);
                $wrapper = "";
                $file_name = "";

            }else if($file_name != ""){
                $wrapper.=  $x . "\n";
            }

        }

        echo "\n Done :: $mod \n";
        unlink($mod.".config");
}
?>