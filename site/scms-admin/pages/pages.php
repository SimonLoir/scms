<?php
if($ic){
?>

    <h1>Gestion des pages</h1>

    <?php
    foreach(scandir("../scms-pages") as $page){
        if($page != "." && $page != ".."){
        ?>
            <div>
                <span class="title">
                    <i>
                        <?= str_replace(".json", "", $page)?>
                    </i>
                </span>
                <a href="../?dev_mod=true&p=<?= str_replace(".json", "", $page) ?>">éditer cette page</a>
            </div>    
        <?php
        }
    }
    ?>

<?php 
}else{exit();}
?>