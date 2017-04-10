<?php
if(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true" && !isset($_SESSION["scms-global-admin-" . sha1(realpath("."))])){
    header('Location: scms-admin');
}elseif(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true" && isset($_SESSION["scms-global-admin-" . sha1(realpath("."))])){
?>
<script data-core-no-index>
$(document).ready(function () {
    $('[data-scms-action-click]').click(function () {
        scms_edit_action(this);
    });
});
</script>
<?php
}else{
?>
<script data-core-no-index>
$(document).ready(function () {
    $('[data-scms-action-click]').click(function () {
        
        var action = this.getAttribute("data-scms-action-click");


        if(action.indexOf('goTo://') == 0){
            action = action.replace('goTo://', "");
            window.location.href = action;
        }else{
            console.log('Unknown destination or action');
        }

    });
});
</script>
<?php
}
?>