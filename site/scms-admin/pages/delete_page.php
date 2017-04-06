<?php
if($ic && isset($_GET["p_name"])){

    if(isset($_GET["delete"])){

        if($_GET["p_name"] == "404"){

            echo "Fatal error : vous ne pouvez pas supprimer la page 404. Cette page est affichée lorsque la page est introuvable.";

        }else{

            echo "Suppression de " . $_GET['p_name'];

            try{

                unlink('../scms-pages/' . $_GET["p_name"] . ".json");
                echo "<br /><span style=\"color:green;\">Page supprimée !</span>";

            }catch(Exception $e){

                echo "<br /><span style=\"color:red;\">Erreur lors de la suppression</span>";
                

            }

        }

    }else{
    
    ?>
        <b>Voulez-vous vraiment supprimer la page <?= $_GET['p_name'] ?> ?</b>
        <a href="?p=delete_page&p_name=<?= $_GET["p_name"]?>&delete=true">Oui</a>
        <a href="?p=pages">Non</a>
    <?php 

    }

}else{exit("! Fatal error : p_name or admin rights");}
?>