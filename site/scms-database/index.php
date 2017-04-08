<?php
include "jsondb.worker.php";

$db = new jdb();

$post = $db->query('SELECT id, content, title FROM posts WHERE id BETWEEN 9 AND 250');

var_dump($post);




?>