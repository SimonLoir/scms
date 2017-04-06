<?php
if(is_file('../site-infos')){
    $site_infos = json_decode(file_get_contents('../site-infos'), true);
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Préparation</title>
</head>
<body>
    <div class="top-nav-bar">
        Installation du site
    </div>
    <div class="content">

        <div class="please-wait">
            <h2>Installation</h2>
            <p>Nous préparons votre site web...</p>
        </div>
    </div>
    <script>
    var global_usr_name = "<?= $_GET["username"] ?>";
    </script>
    <script src="extjs.js"></script>
    <script src="installer.js"></script>
</body>

<style>
.top-nav-bar{
    background:#1976d2;
    color:white;
    position: absolute;
    top: 0;left: 0;right: 0;
    padding: 15px;
    font-size: 25px;
    font-family: sans-serif;

}
body{
    background:white;
    font-family: sans-serif;
}

.content{
    position: absolute;
    top: 70px;left: 0;right: 0;bottom: 0;
    padding: 55px;
    padding-top: 10px;
    text-align:center;
}
label{
    text-align:left;
    display:block;
    width: 310px;
    margin: auto;
}
input, select{
    display: block;
    padding: 5px;
    margin-top: 5px;
    margin-bottom: 10px;
    border:1px solid rgba(0,0,0,0.15);
    border-radius: 4px;
    
}

input{
    width: 300px;
}

input[type="submit"]{
    background:#1976d2;
    color:white;
    cursor:pointer;
    padding: 8px;
    width:auto;
    padding-left: 15px;padding-right: 15px;
    transition:0.25s;
    float:right;
}

input[type="submit"]:hover{
    background:#1565c0;

}
</style>
</html>

<?php

}else{
    exit('Une erreur est survenue, décompressez l\'archive à nouveau !');
}
?>