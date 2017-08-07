<?php
if(!$ic){
exit();
}
?>
<h1>Gérer les liens du menu</h1>

<?php 
    $json = file_get_contents('../site-header.json');

    $links = json_decode($json);

    $pages = scandir('../scms-pages');
?>

Laisser vide pour ne pas afficher de texte.

<form action="#" method="post">

    <?php
        if(isset($_POST["send"])){
            $array = [];
            for ($i=0; $i < 4; $i++) { 
               if(!isset($_POST["title". $i])){
                    exit ("erreur");
               } 
               if(!isset($_POST["page". $i])){
                    exit ("erreur");
               }
               array_push($array, ["title"=> $_POST["title". $i], "page"=> $_POST["page". $i]]);
            }
            file_put_contents("../site-header.json", json_encode($array));
            build($array);
            exit();
        }
    ?>

    <?php $i = 0; foreach ($links as $link) {?>
        Titre du lien : <input type="text" name="<?= 'title'.$i ?>" value="<?= $link->title ?>"> | Lien vers : 
        <select name="<?= 'page'.$i ?>" id="">
            <?php foreach ($pages as $p) { if($p != "." && $p != "..") { $p = str_replace(".json", "", $p);  ?>
                <option value="<?= $p ?>" <?= ($links[$i]->page == $p) ? "selected" : "" ;?> ><?= $p ?></option>
            <?php } } ?>
        </select> <br />        
    <?php $i++; } ?>
    <input type="submit" name="send">
</form>

<?php
function build($array){
    $to_be_writed = "";

    foreach ($array as $a) {
        if($a["title"] != ""){
            $to_be_writed .= '<a href="?p=' . $a["page"] . '" class="scms-header-actions-link">' . $a["title"] . '</a>';
        }
    }

    if(file_put_contents("../site-header.php", $to_be_writed)){
        echo "<p style=\"color:green;\">Mise à jour appliquée ! </p>";
    }else{
        echo "<p style=\"color:red;\">Erreur</p>";        
    }
}
?>