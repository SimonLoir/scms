<?php
if($_GET['phase'] == 1){

    $user_infos = file_get_contents("../site-infos");

    $user_infos = json_decode($user_infos);
    
    $create_folders = [
        "scms-admin",
        "scms-admin/pages",
        "scms-content",
        "scms-content/images",
        "scms-core",
        "scms-modules",
        "scms-pages",
        "scms-theme",
        ""
    ];

    foreach ($create_folders as $folder) {
        if($folder != "" && $folder != ".sass-cache"){

        
        if(!is_dir('../' . $folder)){
            mkdir('../' . $folder);
        }
        $directory = '../' . $folder;

        $dir = scandir("../site/". $folder);

        foreach ($dir as $file) {
            if(is_file("../site/". $folder . "/" . $file)){
                
                $file_content = file_get_contents("../site/". $folder . "/" . $file);

                if($file == "user-credentials.php"){
                    $file_content = str_replace("root", $user_infos->user_email, $file_content);
                    
                    $file_content = str_replace("{password}", $user_infos->user_password, $file_content);
                }

                $file_content = str_replace("S CMS", $user_infos->website_name, $file_content);

                
                $file_content = str_replace("Simon Loir", $user_infos->user_name, $file_content);         

                if(!file_put_contents($directory  . "/" . $file, $file_content)){
                    exit('Fatal error' . $file);
                }


            }else{
                // do nothing
            }
        }

        }else{
            $dir = scandir("../site");

            foreach ($dir as $file) {
                if(is_file("../site/". $file)){

                    $file_content = file_get_contents("../site/". $file);

                    $file_content = str_replace("S CMS", $user_infos->website_name, $file_content);
                    
                    if(!file_put_contents("../" . $file, $file_content)){
                        //exit('Fatal error');
                    }


                }else{
                    // do nothing
                }
            }
        }

    }
    sleep(1);
    exit('IP1Ok');

}elseif($_GET["phase"] == 2){
    $create_folders = [
        "scms-admin/pages",
        "scms-admin",
        "scms-content/images",
        "scms-content",
        "scms-core",
        "scms-modules",
        "scms-pages",
        "scms-theme",
        ""
    ];

    foreach ($create_folders as $folder) {
        if($folder != ""){

        $dir = scandir("../site/". $folder);

        foreach ($dir as $file) {
            if(is_file("../site/". $folder . "/" . $file)){
                
                unlink("../site/". $folder . "/" . $file);

            }else{
                // do nothing
            }
        }

        rmdir("../site/". $folder);

        }else{
            $dir = scandir("../site");

            foreach ($dir as $file) {
                if(is_file("../site/". $file)){

                    unlink("../site/". $file);

                }else{
                    // do nothing
                }
            }

            rmdir("../site");

        }

    }

    $dir = scandir('../installer');

    foreach($dir as $file){
        if(is_file($file)){
            
         unlink("../installer/" . $file);

        }
    }

    rmdir('../installer');

    exit('IP2Ok');
}
?>