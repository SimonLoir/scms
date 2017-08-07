<?php if($ic){ ?>

<h1>SCMS store</h1>

<?php 
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$actual_link = str_replace('/index.php?p=store', "", $actual_link);
$actual_link = str_replace('/?p=store', "", $actual_link);

if(isset($config["allow_other_store"]) && $config["allow_other_store"] == "true"){

    $change_ok = true;


    if(!isset($_GET["s"])){
        $server = $config["store_default_address"];
    }else{
        $server = $_GET["s"];
    }


}else{
    $server = $config["store_default_address"];
    $change_ok = false;    
}

if($server !=  "https://simonloir.be/" && $config["show_warning_if_store_isnt_official"] == "true"){
    echo "<b style=\"color:red;\">Le serveur du store n'est pas le serveur officiel. Faites attention aux applications que vous installez. Ces applications ne sont pas vérifées et peuvent supprimer des applications existantes ou endommager votre site / votre serveur.</b>";
    echo "<br /><br />";
}
?>

version de SCMS : <?php include "../scms-version.php"; ?> <br />
<a href="<?= $server ?>app-store/index.php?server=<?= $actual_link ?>&version=<?= $version ?>">Accèder au store en ligne</a><br /><br />

<?php
if($change_ok){?>
Modifier l'adresse du store : 
<form action="?p=store">
    <input type="text" name="p" value="store" style="display:none;">
    <input type="text" name="s" value="<?= $server ?>">
    <input type="submit" value="Confirmer">
</form>
<?php
}
?>

<h2 id="installed">Applications installées : </h2>

<?php
$dir = scandir('../scms-modules');
$notinstalled = [];
unset($dir[0]);
unset($dir[1]);
foreach ($dir as $d) {
    if(is_dir("../scms-modules/" . $d)){
    ?>
        <div>
            <i><?= $d ?></i> <a href="../scms-modules/remove_module.php?module=<?= $d ?>&gui=true">Supprimer</a>
        </div>
    <?php
    }else if(explode(".", $d)[sizeof(explode(".", $d)) - 1] == "config"){
        $notinstalled[] = $d;
    }
}
?>

<h2 id="to_be_installed">Applications téléchargées non installées : </h2>

<?php

if($notinstalled == []){
    echo "Toutes les applications sont installées !";
} else{
    echo '<a href="../scms-modules/install.php?redir=../scms-admin/?p=store">Installer et mettre à jour mes applications</a>';
}

foreach ($notinstalled as $ni) {
    ?>
        <div>
            <i><?= $ni ?></i>
        </div>
    <?php
}

?>

<?php }else{exit('error');} ?>