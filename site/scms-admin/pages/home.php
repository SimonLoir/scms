<?php if($ic){ ?>
    Bienvenue sur votre panel d'administration !
    <hr />
    <h2>Actions rapides</h2>
    <a href="?p=pages">Gérer les pages</a> | 
    <a href="?p=menu_links">Gérer les liens du menu</a>
    <h2>Désactiver l'accès au site</h2>
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
    <h2>Mises à jour et sécurité</h2>
    <a href="?p=check_update">Mises à jour</a> | 
    <a href="logout.php">Me déconnecter</a>
    <h2>Applications et mises à jour</h2>
    <a href="?p=store_check_update">Mises à jour des applications</a> | 
    <a href="?p=store">Installer des applications</a>
<?php } ?>