<div class="scms-comment-form-block style-simple-band">
<div class="scms-centred-element">
<form action="" method="post">
<?php
if(isset($_POST["send"])){
echo "ok";
if($db->query('INSERT INTO comments VALUES ["", "' . $_GET["p"] .'", "test", "' . $_POST["test"] . '"]')){
echo "done";
}
}
?>
<input type="text" name="test">
<input type="submit" value="send" name="send">
</form>

<?php

$array = $db->query('SELECT * FROM comments WHERE page_name = ' . $_GET["p"]);
var_dump($array);

?>

</div>
</div>

