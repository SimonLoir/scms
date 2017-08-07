<?php
$site_config_string = file_get_contents(dirname(__FILE__) . "/.config");

$site_config_to_array = preg_split('/\r\n|\n|\r/', $site_config_string);

$config = [];

foreach ($site_config_to_array as $line) {
    if(trim($line) != ""){
        $line = explode( "=", $line);
        $config[trim($line[0])] = trim($line[1]);
    }
}

//var_dump($config);
?>