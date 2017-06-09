<div class="scms-basics-iframe style-simple-band"
<?php
if($dev_mod == true){
echo 'onclick="xxx_module_update_iframe_URL_ccc(this)"';
}
?> >
<div class="scms-centred-element">

<iframe src="<?= $e["url"] ?>" frameborder="0" style="width:100%; height:50vh;" allowfullscreen>

</iframe>
</div>
</div>
<script data-core-no-index>
function xxx_module_update_iframe_URL_ccc (e) {
var pr = prompt('url', e.querySelector('iframe').src);
if(pr != null){
e.querySelector('iframe').src = pr;
}
}
</script>


