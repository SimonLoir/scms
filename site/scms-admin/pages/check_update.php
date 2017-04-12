<?php
if(!$ic){
exit();
}

echo 'Version actuelle : <span class="server_version">';

include "../scms-version.php";

echo '</span> version disponible sur le serveur : <span class="online_version">-Waiting for server response-</span>';
?>

<div class="update_button_receiver">
    <br>

</div>

<script>
AR.GET("https://simonloir.be/scms/scms-version.php", function (data){
    $('.online_version').html(data);
    if($('.server_version').html() != data){
        alert('Une mise à jour est disponible.');
        $('.update_button_receiver').child("button").html('Mettre à jour mon installation')
    }
});
</script>

<style>

button{
    position: relative;
    display: inline-block;
    max-width: 300px;
    background: crimson;
    color:white;
    border: none;
    border-radius: 5px;
    padding: 12px;
    padding-left: 25px;padding-right: 25px;
    cursor: pointer;
    transition: 1s;
    margin:auto;
}

button:hover{
        background: white;
        color:crimson;
        border:1px solid crimson;
    }

</style>