<?php
if($ic && is_file("../scms-pages/base.json")){

    if(!isset($_POST["new_page"])){
        exit('Erreur système : access');
    }

    if(!isset($_POST["page_name"])){
        exit('Erreur système : page name');
    }

    if(is_file("../scms-pages/" . $_POST["page_name"] . ".json")){
        exit('cette page existe déjà !');
    }  

    if(file_put_contents("../scms-pages/" . $_POST["page_name"] . ".json", file_get_contents("../scms-pages/base.json"))){
        echo "Page créée avec succès !";
    }else{
        echo "Erreur !";
    }
}
?>