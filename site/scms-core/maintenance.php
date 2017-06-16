<?php if(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true"){}else{
?>
<div class="fullscreen">
    <div class="centred-content">
        <h1>Maintenance</h1>

        <p>We are sorry but this website is unavailable for maintenance purpose. Come back in a few hours.<br />Nous sommes désolés mais ce site web est indisponible pour maintenance. Revenez dans quelques heures. <br />Admin email : fake-email@fake-fake.fakeland</p>
    </div>
</div>

<style>
.fullscreen{
    position:fixed;
    top: 0;left: 0;right: 0;bottom: 0;
    z-index:100;
    padding: 0;
    text-align:center;
    background:#F2F2F2;
    color:rgb(100,100,100);
}
h1{
    margin-bottom: 50px;
}

.centred-content{
    position:fixed;
    top: 50%;
    left: 50%;
    transform:translateX(-50%) translateY(-55%);
    background:transparent;
    margin: 0;padding: 25px;
}
</style>
<?php
exit();
}?>
