<?php
include "jsondb.worker.php";

$db = new jdb();

$post = $db->query('SELECT * FROM posts WHERE id = '. $_GET["id"]);

var_dump($post);


?>