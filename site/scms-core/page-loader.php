<?php
if(is_file('scms-pages/' . $page_global . ".json")){
    $page = file_get_contents( 'scms-pages/' . $page_global . ".json");
}else{
    $page = file_get_contents('scms-pages/404' . ".json");
}

$p = json_decode($page, true);

$db = new jdb();

foreach ($p as $e) {
    if($e["type"] == "full-screen-landing-image"){
        if(isset($e["module"]) && $e["module"] == "core"){
           $module = "core"; 
        }elseif(!isset($e["module"])){
            $module = "core";
        }else{
            $module = $e["module"];
        }

        if($module == "core"){

            if(isset($e["text"])){
                $text = nl2br($e["text"]);
            }else{
                $text = "";
            }

            if(isset($e["element-height"])){
                $h = $e["element-height"];
            }else{
                $h = "450px";
            }

            echo '<div class="scms-landing-image" style="height:' . $h . ';background:url(' . $e["resource-img-src"] .') no-repeat;background-position:center;background-size:cover;position:relative;"><span style="color:white;font-size:50px;position:absolute;top:50%;left:50%;transform: translateX(-50%) translateY(-50%);text-shadow:0px 0px 8px rgba(0,0,0,0.45);text-align:center;">' . $text . '</span></div>';
        }
    }elseif($e["type"] == "footer-element"){
        if(isset($e["module"]) && $e["module"] == "core"){
           $module = "core"; 
        }elseif(!isset($e["module"])){
            $module = "core";
        }else{
            $module = $e["module"];
        }

        if($module == "core"){

            echo '<div class="scms-footer">&copy; Copyright 2017 <span id="copyright_owner">' . $e["copyright_name"] . '</span> - Tous droits réservés</div>';
            
        }
    }elseif($e["type"] == "404-div"){
        if(isset($e["module"]) && $e["module"] == "core"){
           $module = "core"; 
        }elseif(!isset($e["module"])){
            $module = "core";
        }else{
            $module = $e["module"];
        }

        if($module == "core"){

            echo '<div class="scms-landing-image" style="height:700px;background:url(' . "scms-content/images/404.jpg" .') no-repeat;background-position:center;background-size:cover;position:relative;"><span style="color:white;font-size:50px;position:absolute;top:50%;left:50%;transform: translateX(-50%) translateY(-50%);text-shadow:0px 0px 8px rgba(0,0,0,0.45);text-align:center;">' . $e["content"] . '<span></div>';            
            
        }
    }elseif($e["type"] == "content-element"){
        if(isset($e["module"]) && $e["module"] == "core"){
           $module = "core"; 
        }elseif(!isset($e["module"])){
            $module = "core";
        }else{
            $module = $e["module"];
        }

        if($module == "core"){

            if($e["content-type"] == "text-only"){

                $html = $e["content"];

            }else{

                $html = getHTMLFromModulesArray($e["content"]);

            }

            echo '<div class="scms-content-block"><div class="scms-centred-element">' . $html . '</div></div>';

        }
    }elseif($e["type"] == "comp-element"){
        if(isset($e["module"]) && $e["module"] == "core"){
           $module = "core"; 
        }elseif(!isset($e["module"])){
            $module = "core";
        }else{
            $module = $e["module"];
        }

        if($module == "core"){

            if($e["content-type"] == "text-only"){

                $html = $e["content"];

            }else{

                $html = getHTMLFromModulesArray($e["content"]);

            }

            echo '<div class="scms-content-block"><div class="scms-centred-element scms-compare-block">' . $html . '</div></div>';

        }
    }elseif(isset($e["module"]) && $e["module"] != "core"){
        
        $dir = "scms-modules/" . $e["module"];

        if(is_dir($dir)){

            $map = $dir . "/map.json";

            $x_map = json_decode(file_get_contents($map), true);

            foreach ($x_map as $extension) {
                if($extension["class"] == $e["type"]){
                    include $dir."/".$extension["gen-code"];
                }else{
                    echo "<!--code-error-->";
                }
            }

            

        }else{
            echo '<div class="scms-content-block" data-core-no-index><div class="scms-centred-element">Erreur de construction de site : le module '. $e["module"] . ' est introuvable. </div></div>';
        }
        
    }elseif($e["type"] == "page-infos"){
            
    }else{
        exit("Erreur dans la conception du site.");
    }
}

function getHTMLFromModulesArray ($array) {

    $html = "";

    foreach ($array as $e) {

        if(isset($e["module"]) && $e["module"] != "core"){
            
            $dir = "scms-modules/" . $e["module"];

            if(is_dir($dir)){

                $map = $dir . "/map.json";
                $x_map = json_decode(file_get_contents($map), true);
                foreach ($x_map as $extension) {
                    if($extension["class"] == $e["type"]){
                        include $dir."/".$extension["gen-code"];
                    }else{
                        echo "<!--code-error-->";
                    }
                }
            }else{
                echo '<div class="scms-content-block" data-core-no-index><div class="scms-centred-element">Erreur de construction de site : le module '. $e["module"] . ' est introuvable. </div></div>';
            }
        }else{

            if(!isset($e["type"])){
                exit('Site::Configuration error');
            }

            $type = $e["type"];

            if($type == "title-element"){

                $html .= "<h2 class=\"scms-content-block-title\">" . nl2br($e["text"]) . "</h2>";

            }elseif($type == "paragraph-element"){

                $html .= "<p class=\"scms-content-block-paragraph\">" . nl2br($e["text"]) . "</p>";

            }elseif($type == "comp-part"){

                if($e["content-type"] == "text-only"){
                    $xhtml = $e["content"];
                }elseif($e["content-type"] == "text-array"){
                    $xhtml = getHTMLFromModulesArray($e["content"]);
                }

                $html .= "<div class=\"scms-compare-block-cel\">" . $xhtml . "</div>";

            }elseif($type == "title-element-big"){

                $html .= "<h2 class=\"scms-content-block-title big\" style=\"\">" . nl2br($e["text"]) . "</h2>";

            }elseif($type == "list-element"){
                
                $html .= "<ul class=\"scms-list-block\">";

                foreach ($e["items"] as $item) {
                    $html .= "<li>{$item}</li>";
                }

                $html .= "</ul>";

            }elseif($type == "big-action-button"){

                $html .= "<button class=\"scms-big-action-button scms-to-bottom\">" . nl2br($e["text"]) . "</button>";

            }elseif($type == "simple-action-button"){

                $html .= "<button class=\"scms-simple-action-button\" data-scms-action-click=\"" . $e["action"] . "\">" . nl2br($e["text"]) . "</button>";

            }else{
                exit("Unknown element used in site configuration" . $e["type"]);
            }

        }

    }

    return $html;

}

?>
