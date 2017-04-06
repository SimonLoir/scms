<?php
if($ic && is_file("../scms-pages/base.json")){
?>

    <h1>Gestion des pages</h1>

    <h2>Actions rapides</h2>

    <?php
    foreach(scandir("../scms-pages") as $page){
        if($page != "." && $page != ".." && $page != "base.json"){
        ?>
            <div>
                <span class="title" style="width:200px;display:inline-block;">
                    <b>
                        <?= str_replace(".json", "", $page)?>
                    </b>
                </span>
                <a href="../?dev_mod=true&p=<?= str_replace(".json", "", $page) ?>">éditer cette page</a>  |  <a href="?p=delete_page&p_name=<?= str_replace(".json", "", $page) ?>">supprimer cette page</a>
            </div>    
        <?php
        }
    }
    ?>

    <h2>Nouvelle page</h2>
    
    <p>
        Pour éviter d'avoir des problèmes d'encodage, veuillez ne pas utiliser d'espaces, d'accents et de caractères spéciaux dans le nom des pages.
    </p>

    <form action="?p=new_page" method="post">
        <input type="text" name="page_name" placeholder="Nom de la page" style="width:200px;">
        <input type="submit" value="Créer cette page">
    </form>


<?php 
}else{exit("! Fatal error : file base.json in scms-pages or admin rights");}
?>