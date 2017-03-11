<?php

if(isset($_SESSION["scms-global-admin"])){
?>

    <div class="gest-panel">
        <h2>Gérer les pages</h2>
        <p>Accèdez à l'espace de gestion des pages.</p>
    </div>

<?php
}else{
    exit('error');
}

?>