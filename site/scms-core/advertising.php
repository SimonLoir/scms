<?php
if(is_file('show_pub')){
?>
<div class="scms-advertising made-with" data-core-no-index>
    Made with SCMS free version, make your own website now !
</div>
<?php
}
?>

<style data-core-no-index>
.scms-advertising{
    position: fixed;
    right: 1px;
    bottom: 1px;
    background:#ce1338;
    font-family: sans-serif;
    color:white;
    padding-top: 8px;
    padding-bottom: 8px;
    padding-left: 12px;padding-right: 12px;
    border-radius: 4px;
}

.made-with{
    cursor: pointer;
    font-size:10px;
    transition:0.75s;
}

.made-with:hover{
    font-size: 14px;
}
</style>
<script data-core-no-index>
$('.made-with').click(function () {window.location.href = "http://simonloir.be/s";});
</script>

