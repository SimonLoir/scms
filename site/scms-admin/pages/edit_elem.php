<?php
if($ic && isset($_GET["page"])){
    $page = json_decode(file_get_contents("../scms-pages/" . $_GET["page"]. ".json"), true);
    $array = getFromPos($_GET["id"], $page);

    foreach (array_keys($array) as $key) {
        if (gettype($array[$key]) == "string") {
        ?>
            <label for="<?= $key ?>"><?= $key ?> : <input type="text" value="<?= (gettype($array[$key]) == "string") ? $array[$key] : "//"  ?>"></label>
            <br />
        <?php
        }else{
            echo $key . " = array <br />";
        }
    }

}else{exit();}

function getFromPos($pos, $page){
    $posx = explode( ">", $pos);
    $array = $page;
    $i = 0;
    foreach ($posx as $posy) {
        $array = $array[$posy];
        if($i < sizeof($posx) - 1){

            if(isset($array["content"])){
                $array = $array["content"];
            }

        }
        $i++;
    }
    return $array;
}
?>
