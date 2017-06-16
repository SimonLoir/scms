<?php
if(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true"){
$a =  'onclick="scms_basics_image_simple_update(this)"';
}else{
$a = "";
}
$html.= '
<img src="' . $e["src"] .'" style="max-width:100%;" class="scms-simple-image" ' . $a . '>
';
?>

<script data-core-no-index>
function scms_basics_image_simple_update (e) {
var pr = prompt('url', e.src);
if(pr != null){
e.src = pr;
}
}
</script>




