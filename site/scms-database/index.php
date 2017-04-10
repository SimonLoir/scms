<?php
include "jsondb.worker.php";

$db = new jdb();

if($db->query('INSERT INTO posts VALUES ' . json_encode(["", "test", "hihi"]))){
    /**
    * Il n'y a pas de problème, tout se passe comme prévu, l'exécution se passe sans problème et la reqsuête est effectuée sans aucune difficulté. C'est cool
    */
}

?>