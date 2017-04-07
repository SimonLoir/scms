<?php if($ic){ ?>
    Bienvenue sur votre panel d'administration !
    <hr />
    <h2>Actions rapides</h2>
    <a href="?p=pages">Gérer les pages</a> | 
    <a href="?p=menu_links">Gérer les liens du menu</a>
    <h2>Zone de danger</h2>
    <?php
    if(isset($_GET["maintenance"])){
        $s = $_GET["maintenance"];
        if($s == "true"){
            if(!is_file("../blocked")){
                file_put_contents("../blocked", "--");
            }
        }else{
            if(is_file("../blocked")){
                unlink("../blocked");
            }
        }
    }
    ?>
    <?= (is_file("../blocked")) ? 'mode maintenance activé <a href="?p=home&maintenance=false"> Désactiver</a>' : 'mode maintenance désactivé <a href="?p=home&maintenance=true"> Activer</a>' ; ?>
<?php } ?>