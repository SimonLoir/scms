<?php
$files = scandir('.');
$farray = [];
foreach ($files as $file) {
    if($file != "." && $file != ".." && $file != "list.php"){
        array_push($farray, $file);
    }
}

exit(json_encode($farray));
?>