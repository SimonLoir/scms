<?php if($ic){ ?>

<h1>SCMS store</h1>

<?php 
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$actual_link = str_replace('/index.php?p=store', "", $actual_link);
$actual_link = str_replace('/?p=store', "", $actual_link);

?>

version de SCMS : <?php include "../scms-version.php"; ?>

<a href="https://simonloir.be/app-store/index.php?server=<?= $actual_link ?>&version=<?= $version ?>">Accèder au store en ligne</a>

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
            <i><?= $d ?></i>
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