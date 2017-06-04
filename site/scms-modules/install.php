<?php
session_start();
if(isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])){

    if(isset($_GET["mi"])){

        $mod = $_GET["mi"];

        $file = file_get_contents($_GET["mi"] . ".config");

        $file = explode("\n", $file);

        $wrapper = "";
        $file_name = "";

        if(trim($file[0]) != "@doctype installation-config-file"){
            exit("Installation media - error");
        }

        for ($i=0; $i < sizeOf($file); $i++) { 

            $x = trim($file[$i]);

            if(strpos($x , "@folder ") === 0){

                $folder_name = str_replace("@folder ", "", $x);

                if(!is_dir($folder_name)){
                    mkdir($folder_name);
                }else{
                    exit("Config_error -> config file :: folder");
                }

            }else if(strpos($x , "@file~write ") === 0){

                $file_name = str_replace("@file~write ", "", $x);

            }else if(strpos($x , "@require version ") === 0){

                include "../scms-version.php";

                $v = str_replace("@require version ", "", $x);

                if($v != $version){
                    exit('Version error');
                }

            }else if(strpos($x , "@file~close ") === 0){

                $filexxx = str_replace("@file~close ", "", $x);


                if($filexxx != $file_name){
                    exit('Config error');
                }

                file_put_contents($filexxx, $wrapper);
                $wrapper = "";
                $file_name = "";

            }else if($file_name != ""){
                $wrapper.=  $x . "\n";
            }

        }

    }

}else{
    echo ":error:";
}
?>