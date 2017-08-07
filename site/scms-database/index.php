<?php
include "jsondb.worker.php";

$db = new jdb();

if($db->query('CREATE TABLE test KEYS = ["id", "test", "y"]')){
    exit('ok');
}else{
    exit('File error');
}

?>