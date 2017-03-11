<?php

if(!is_file("site-status")){
    if(is_file("site-infos")){
        header('Location: installer');
    }
    exit('Ce site est déjà installé');
}

$site_status = file_get_contents('site-status');

if($site_status == "installed"){
    exit('Ce site est déjà installé.');
}

$progress_state = 0;

if(isset($_GET['force_progress'])){
    $progress_state = $_GET["force_progress"];
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Installation du site</title>
</head>
<body>
    <div class="top-nav-bar">
        Configurer mon site
    </div>
    <div class="content">
    <?php
    if($progress_state == 0){
        ?>
            
            <form action="" method="post">
                <?php
                    $name = "";
                    $email = "";
                    $password = "";

                    if (isset($_POST['step_1_finish'])) {
                        
                        $e = false;

                        if($_POST["name"] != ""){
                            $name = $_POST['name'];
                        }else{
                            echo '<p style="color:Crimson;">' .  "Username incorrect" . '</p>';
                            $e = true;
                        }

                        if($_POST["email"] != ""){
                            $email = $_POST['email'];
                        }else{
                            echo '<p style="color:Crimson;">' .  "Email incorrect" . '</p>';
                            $e = true;
                        }

                        if($_POST["password"] != ""){
                            $password = $_POST['password'];
                        }else{
                            echo '<p style="color:Crimson;">' .  "Mot de passe incorrect" . '</p>';
                            $e = true;
                        }

                        if($password != $_POST['password-repeat']){
                            echo '<p style="color:Crimson;">' .  "Les mots de passe ne concordent pas. " . '</p>';
                            $e = true;
                        }

                        if($e == false){

                            $user_infos = [
                                "user_name" => $name,
                                "user_email" => $email,
                                "user_password" => $password,
                                "website_name" => "",
                                "website_type" => "",
                                "website_is_ready" => "false",
                                "website_autority_private_key" => "",
                                "website_theme" => "default",
                                "website_copyright" => "true"
                            ];

                            header('Location: site-install.php?force_progress=1&user_json=' . urlencode(json_encode($user_infos)));
                        }

                    }
                ?>
                <h2>Créez votre compte</h2>

                <p> <label for="Name">Nom : <input type="text" name="name" value="<?= $name ?>"></label></p>
                <p> <label for="Name">Email : <input type="text" name="email" value="<?= $email ?>"></label></p>
                <p> <label for="Name">Mot de passe : <input type="password" name="password" value="<?= $password ?>"></label></p>
                <p> <label for="Name">Mot de passe (répeter): <input type="password" name="password-repeat"></label></p>
                <p> <label for=""><input type="submit" value="Confirmer et continuer" name="step_1_finish"></label></p>
            </form>
        <?php
    }elseif($progress_state == "1"){
         ?>
            
            <form action="" method="post">
                <?php

                    $name = "";

                    if (isset($_POST['step_1_finish'])) {
                        

                        $e = false;

                        if($_POST["name"] != ""){
                            $name = $_POST['name'];
                        }else{
                            echo '<p style="color:Crimson;">' .  "Nom du site incorrect" . '</p>';
                            $e = true;
                        }

                        if($_POST["site-type"] != ""){
                            $site_type = $_POST['site-type'];
                        }else{
                            echo '<p style="color:Crimson;">' .  "Type de site incorrect" . '</p>';
                            $e = true;
                        }

                        if($e == false){
                            $a = json_decode(urldecode($_GET['user_json']), true);

                            $a['website_type'] = $site_type;
                            $a["website_name"] = $name;

                            header('Location: site-install.php?force_progress=2&user_json=' . urlencode(json_encode($a)));
                        }
                    }
                ?>
                <h2>Configurez votre site</h2>

                <p> <label for="Name">Nom du site (titre): <input type="text" name="name" value="<?= $name ?>"></label></p>

                <p> <label for="Name">Type de site: <select name="site-type">
                    <option value="all">Pas encore décidé</option>
                    <option value="blog">Blog</option>
                    <option value="portfolio">Portfolio</option>
                    <option value="ecommerce">E-commerce</option>
                    <option value="vitrine">Site vitrine</option>
                </select> </label></p>
                
                
                <p> <label for=""><input type="submit" value="Confirmer et continuer" name="step_1_finish"></label></p>
            </form>
        <?php
    }elseif($progress_state == "2"){

        file_put_contents('site-infos', urldecode($_GET["user_json"]));

        unlink("site-status");

        header('Location: installer');

    }
    ?>
    </div>
</body>
</html>

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


