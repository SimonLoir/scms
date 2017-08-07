<?php
if($ic) {

    if(isset($_GET["folder"])){
        $folder = $_GET["folder"];
    }else{
        $folder = "";
    }

    $dir = scandir("../scms-content/" . $folder);

    echo realpath("../scms-content/" . $folder) . '<br />';
?>
<button style="position:absolute;top:20px;right:25px;">Uploader</button>
<br />
<table>
    <tr>
        <th>file or directory</th>
        <th>actions</th>
    </tr>
<?php

    if( strpos(realpath("../scms-content/" . $folder), realpath("../scms-content/")) === 0 ) {
        foreach ($dir as $option) {
            $url = '../scms-content/' . $folder . '/'. $option;
            $url = str_replace('../scms-content/', "", $url);
            $url = str_replace('/././', "/", $url);

            echo "<tr><td>";

            if(is_dir("../scms-content/" . $url)){
                echo '
                    <a href="?p=file_manager&folder=' . $url . '">
                        <span class="ff">' . $option . '</span>
                    </a>
                ';
            }else{
                echo '
                        <span class="ff">' . $option . '</span>
                        <br />
                ';
            }
            echo "</td>";

            if($option != "." && $option != ".."){
                echo '<td>
                <a href="">Supprimer</a>
                 || 
                 <a href="">Éditer</a>  
                 || 
                 <a href="">Renommer</a></td>';
            }else{
                echo "<td></td>";
            }
            
            echo "</tr>";
        }
    }else{
        header('Location:?p=file_manager');
    }
}
?>

</table>
