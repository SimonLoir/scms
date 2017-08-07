<?php
if(!$ic){
exit();
}

echo "<h1>Pages des logs</h1>";

if(is_file("login.log")){
    echo '<p id="login">' . nl2br(file_get_contents("login.log")) . "</p>";
}

?>