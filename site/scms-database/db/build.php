<?php

$array = [];

for ($i=1; $i < 3; $i++) { 
    array_push($array, [
        $i, "Hello world",
        "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum in doloribus, corporis maiores nulla commodi cumque aliquam repellendus, repellat, quasi et excepturi ea officia maxime. Soluta quibusdam debitis nobis, suscipit."]);
}

$a = json_encode($array);

file_put_contents('table-posts.json', $a);
?>
