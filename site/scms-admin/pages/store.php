<?php if($ic){ ?>

<h1>SCMS store</h1>

<h2 id="trends">Applications à la une :</h2>

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
    }else if(explode(".", $d)[sizeof(explode(".", $d)) - 1] == "config" && !is_dir("../scms-modules/" . str_replace('.config', "", $d))){
        $notinstalled[] = $d;
    }
}
?>

<h2 id="to_be_installed">Applications téléchargées non installées : </h2>

<?php

if($notinstalled == []){
    echo "Toutes les applications sont installées !";
} else{
    echo '<a href="../scms-modules/install.php?redir=../scms-admin/?p=store">Installer mes applications</a>';
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