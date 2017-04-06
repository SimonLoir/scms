<?php
if($ic && isset($_GET["page"])){
    $page = json_decode(file_get_contents("../scms-pages/" . $_GET["page"]. ".json"), true);
    view($page);
    

}else{exit();}

function view($page, $position = "") {
    if(!is_array($page)){
        return;
    }
    for ($i=0; $i < sizeof($page); $i++) { 
        $e = $page[$i];
        if(is_string($e)){
        ?>
            <p><b><?= $e ?></b></p>
        <?php
        }else{
        ?>
            <div class="element">
                <b>[<?= $position . $i ?>] <?= $e["type"] ?></b>

                <button class="edit-element-button" data-id="<?= $position . $i ?>">
                    Modifier
                </button>

                <ul>
                    <?php foreach (array_keys($e) as $key) { $real_pos = $position . $i . ">";?> 

                        <li> 
                            <?= $key ?> :  <?= gettype($e[$key]) == "array" ? view($e[$key], $real_pos) : $e[$key] ?>
                        </li> 

                    <?php }?>
                </ul>

            </div>
        <?php
        }
    }
}
?>

<style>
.element {
    background:white;
    border:1px solid rgba(24,24,24, 0.45);
    margin: 25px;
    padding: 15px;
    color:rgba(0,0,0,0.65);
}
</style>


<script src="pages/page-edit-js.js"></script>