<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site non installé !</title>
</head>
<body>
    <div>
        <span class="title">Site non installé</span><br /><br />
        <span><a href="site-install.php">Cliquez ici pour installer le site</a></span>
    </div>
    <style>
        body{
            background:rgba(0,0,0,0.8);
            font-family:sans-serif;
        }

        div{
            text-align:center;
            width: 320px;
            height: 80px;
            padding: 80px;
            background:rgba(0,0,0,0.05);
            border:1px solid rgba(0,0,0,0.25);
            color:white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform:translateX(-50%) translateY(-50%);
            box-shadow:0px 0px 15px rgba(255,255,255,0.25);
            border-radius:4px;
        }
        div span.title{
            font-size:45px;
        }
        div a{
            color:crimson;
            text-decoration:none;
        }
    </style>
</body>
</html>