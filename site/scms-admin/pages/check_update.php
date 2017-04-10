<?php
if(!$ic){
exit();
}

echo 'Version actuelle : <span class="server_version">';

include "../scms-version.php";

echo '</span> version disponible sur le serveur : <span class="online_version">-Waiting for server response-</span>';


?>

<script>

AR.GET("https://simonloir.be/scms/scms-version.php", function (data){
    $('.online_version').html(data);
    if($('.server_version').html() != data){
        alert('Une mise à jour est disponible.');
    }
});
</script>