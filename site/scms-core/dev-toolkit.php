<?php if(isset($_GET["dev_mod"]) && $_GET["dev_mod"] == "true"){ ?>

<div class="scms-admin-assistant" data-core-no-index>
    <button id="scms-get-json">
        Save
    </button>
    <button id="scms-new-element">
        New
    </button>
    <button id="scms-modules">
        Modules
    </button>
</div>

<?php
/*  ---------------------------------------------------------------------------  */
/*  ----------       Getting data about modules and extensions       ----------  */
/*  ---------------------------------------------------------------------------  */

$modules = [];

foreach (scandir("scms-modules") as $thing) {
    
    $relative_path = 'scms-modules/' . $thing;

    if($thing != "." && $thing != ".." && is_dir($relative_path)){

        $map = $relative_path . "/map.json";

        if(is_file($map)){   

            $module_array = json_decode(file_get_contents($map), true);
            
            $keys = array_keys($module_array);

            foreach ($keys as $key) {
                
                $extension = $module_array[$key];
            
                $module = [
                    "is_block" => $extension["isBlock"],
                    "catch_class" => $extension["class"],
                    "display_name" => $extension["disp-name"],
                    "js_code_builder" => file_get_contents($relative_path . "/" . $extension["htm-code"]),
                    "getter_code" => file_get_contents($relative_path . "/" . $extension["get-code"])
                ];
            
                array_push($modules, $module);

            }

        }

    }

}

$block_can_delete = "";

foreach ($modules as $mod) {
    
    if($mod["is_block"]){
        $block_can_delete .= ", ." . $mod["catch_class"];
    }

}

?>
<script data-core-no-index>
    var modules = <?= json_encode($modules) ?>;
        console.log(modules);
</script>
<?php


/*  ---------------------------------------------------------------------------  */
?>


<script data-core-no-index>
var els = document.querySelectorAll("h1, h2, h3, h4, h5, h6, span, p, button");

for (var i = 0; i < els.length; i++) {
    var element = els[i];
    element.setAttribute('contenteditable', "true");
}

var must_reload = false;

var btns_delete = $('.scms-content-block, .scms-landing-image<?= $block_can_delete ?>').child('button').html('Supprimer cet élément');

    btns_delete.addClass('scms-editor-delete-element');

    for (var i = 0; i < btns_delete.node.length; i++) {
        var element = btns_delete.node[i];
        element.setAttribute('data-core-no-index', " ");
    }
    btns_delete.click(function () {
        var delete_one = confirm('Voulez vous supprimer cet élément et tous ses enfants ?');

        if(delete_one == true){
            $($(this).get(0).parentElement).remove();
            alert('Si vous avez supprimé cet élément par erreur, actualisez la page sans sauvegarder.');
        }
    });


var update_image = $('.scms-landing-image').child('button').html('Modifier l\'image.');
    for (var i = 0; i < update_image.node.length; i++) {
        var element = update_image.node[i];
        element.setAttribute('data-core-no-index', " ");
    }
    update_image.addClass('scms-editor-delete-element');
    update_image.click(function () {
        var el = this.parentElement;
        var x_window = $('body').child('div');
            x_window.addClass('scms-element-window');
            x_window.html('<h1>Choisir une image</h1><br />');

            AR.GET('scms-content/images/list.php', function (data){
                var cancel_button = x_window.child('button').html("annuler").click(function () {
                    x_window.remove();
                });
                cancel_button.addClass('exit-button');
                x_window.child('br');
                try {
                    data = JSON.parse(data);

                    for (var i = 0; i < data.length; i++) {
                        var element = data[i];
                        
                        var img = x_window.child('img').get(0);
                            img.style.maxWidth = "250px";
                            img.style.width = "100%";
                            img.src = "scms-content/images/" + element;
                            img.style.display = "inline-block";
                            img.style.margin = "15px";
                            img.style.verticalAlign = "middle";

                            $(img).click(function () {
                                var confirm_choice = confirm('Voulez vous vraiment utiliser cette image ?');

                                if(confirm_choice == true){
                                    x_window.remove();
                                    el.style.backgroundImage = "url(" + this.src +")";
                                }
                            });
                            
                    }

                } catch (error) {
                    alert(error.message);
                }
            }, function() {
                    alert('Une erreur est survenue lors de la récupération du contenu.');
            });

    });
var update_height = $('.scms-landing-image').child('button').html('Modifier la taille');
    for (var i = 0; i < update_height.node.length; i++) {
        var element = update_height.node[i];
        element.setAttribute('data-core-no-index', " ");
    }
    update_height.addClass('scms-editor-delete-element');
    update_height.click(function () {
        var el = this.parentElement;
        var p = prompt("Taille de l'élément : ", el.style.height.replace('px', ""));

        if(p != null){
            el.style.height = p + "px";
        }
    });

$('#scms-get-json').click(function () {
    btns_delete.remove();
    update_image.remove();
    update_height.remove();
    var array = [];
    var direct_nodes = $('.scms-content-container').get(0).childNodes;

    for (var i = 0; i < direct_nodes.length; i++) {
        var element = direct_nodes[i];
        
        if(element.nodeType == 1 && element.hasAttribute('data-core-no-index') == false){
            array.push(getElementArray(element));
        }

    }

    AR.POST("scms-admin/pages/update_page.php?p=<?= $_GET['p'] ?>", {page_json: encodeURIComponent(JSON.stringify(array))}, function (data) {
        if(data == "Ok"){
            window.location.reload(true);
        }
    });
    
});

function getElementArray(element){
    if(element.classList.contains("scms-footer")){
        var x_result = {
            type:"footer-element",
            module: "core",
            copyright_name : element.querySelector('#copyright_owner').innerText
        }
        return x_result;
    }else if(element.classList.contains("scms-landing-image")){
        var x_result = {
            type : "full-screen-landing-image",
            "resource-img-src" : element.style.backgroundImage.replace('url(', "").replace(')', "").replace('"', '').replace('"', ''),
            "element-height" : element.style.height,
            module : "core",
            text : element.innerText
        }
        return x_result;
    }else if(element.classList.contains("scms-content-block")){

        var direct_nodes = element.childNodes;
    
        for (var i = 0; i < direct_nodes.length; i++) {
            var element = direct_nodes[i];
            if(element.classList.contains('scms-compare-block')){
                return getElementArray(element);
            }
        }

        var x_result = {
            type: "content-element",
            module: "core",
            "content-type": "text-array",
            content: getContent(element)
        }
        return x_result;
    }else if(element.classList.contains("scms-centred-element") && element.classList.contains("scms-compare-block") == false){
    }else if(element.classList.contains("scms-content-block-title")){

        if(element.classList.contains('big')){
            var type_ee = "title-element-big";
        }else{
            var type_ee = "title-element";
        }

        var x_result = {
                type: type_ee ,
                module: "core",
                text: element.innerText
            }
        return x_result;
    }else if(element.classList.contains("scms-content-block-paragraph")){
        var x_result = {
                type: "paragraph-element",
                module: "core",
                text: element.innerText
            }
        return x_result;
    }else if(element.classList.contains("scms-content-block-paragraph")){
        var x_result = {
                type: "paragraph-element",
                module: "core",
                text: element.innerText
            }
        return x_result;
    }else if(element.classList.contains("scms-compare-block")){
            var x_result = {
                type: "comp-element",
                "content-type": "text-array",
                content:getContent(element)
            }
        return x_result;
    }else if(element.classList.contains("scms-compare-block-cel")){
            var x_result = {
                type: "comp-part",
                "content-type": "text-array",
                content:getContent(element)
            }
        return x_result;
    }else if(element.classList.contains("scms-list-block")){
            var x_result = {
                type: "list-element",
                module: "core",
                items: getListItems(element)
            }
        return x_result;
    }else if(element.classList.contains("scms-big-action-button")){
            var x_result = {
                type: "big-action-button",
                module: "core",
                text: element.innerText
            }
        return x_result;
    }else if(element.classList.contains("scms-simple-action-button")){
            var x_result = {
                type: "simple-action-button",
                module: "core",
                text: element.innerText, 
                action : element.getAttribute("data-scms-action-click")
            }
        return x_result;
    }else{
 
        for (var i = 0; i < modules.length; i++) {
            var elm = modules[i];
            if(element.classList.contains(elm.catch_class)){
                return eval(elm.getter_code);
            }
           
        }
        alert('Not found')
         return {};
    }
}

function getContent(e){
    var array = [];
    
    var direct_nodes = e.childNodes;

    for (var i = 0; i < direct_nodes.length; i++) {

        var element = direct_nodes[i];
        
        if(element.nodeType == 1 && element.hasAttribute('data-core-no-index') == false ){
            array.push(getElementArray(element));
        }

        if(element.nodeType == 1 && element.classList.contains("scms-centred-element") && element.classList.contains("scms-compare-block") == false){
            return getContent(element);
        }

    }
    return array;
}

function getListItems(e) {
    var array = [];
    var li = e.querySelectorAll('li');
    for (var i = 0; i < li.length; i++) {
        var element = li[i];
        array.push(element.innerText);
    }
    return array;
}

$('#scms-modules').click(function () {
    window.location.href = "scms-admin?p=store";
});

$('#scms-new-element').click(function () {

    var x_window = $('body').child('div');
        x_window.addClass('scms-element-window');
        x_window.html('<h1>Ajouter un élément</h1><br />');

    var exit = x_window.child('button');
        exit.html('Annuler');
        exit.click(function () {
            x_window.remove();
        });
        exit.addClass('exit-button');

    var btn_cblock = x_window.child('button').html('Ajouter un block de contenu');
        btn_cblock.click(function () {
            to_add = "cblock";
            x_window.remove();
        });

    var btn_title = x_window.child('button').html('Ajouter un block de titre');
        btn_title.click(function () {
            to_add = "text-title";
            x_window.remove();
        });

    var btn_title = x_window.child('button').html('Ajouter une zone de texte');
        btn_title.click(function () {
            to_add = "text-paragraph";
            x_window.remove();
        });
    
    var btn_btn_action = x_window.child('button').html('Ajouter un bouton clickable');
        btn_btn_action.click(function () {
            to_add = "action-button";
            x_window.remove();
        });
        //landing-image
    var btn_landing_image = x_window.child('button').html('Image plein écran (largeur)');
        btn_landing_image.click(function () {
            to_add = "landing-image";
            x_window.remove();
        });

    for (var i = 0; i < modules.length; i++) {
        var element = modules[i];

        var btn_extension = x_window.child('button').html(element.display_name);
            btn_extension.get(0).setAttribute("data-x-id", i);
        btn_extension.click(function () {
            to_add = "scms-extension-" + this.getAttribute("data-x-id");
            x_window.remove();
        });

    }
});

var to_add = "";

$('.scms-content-block, .scms-footer, .scms-compare-block, .scms-landing-image<?= $block_can_delete ?>').click(function () {
    
    if(to_add == "cblock"){

        var div = document.createElement('div');
        $(div).addClass('scms-content-block');
        var idiv = $(div).child('div').addClass('scms-centred-element');    
        this.parentElement.insertBefore(div, this);
        must_reload = true;
        $('#scms-get-json').click();

    }else if(to_add == "text-title"){

        if(this.childNodes[0] != undefined && this.childNodes[0].classList.contains("scms-centred-element")){
            var e = this.childNodes[0];

            $(e).child("h2").html('Some text').addClass('scms-content-block-title');
            must_reload = true;
            $('#scms-get-json').click();

        }

    }else if(to_add == "text-paragraph"){

        if(this.childNodes[0] != undefined && this.childNodes[0].classList.contains("scms-centred-element")){
            var e = this.childNodes[0];

            $(e).child("p").html('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam quibusdam et, fuga ullam, similique, aut fugit amet beatae iste iusto nulla. Architecto aliquid saepe cumque vitae reiciendis sequi repellendus obcaecati.').addClass('scms-content-block-paragraph');
            must_reload = true;
            $('#scms-get-json').click();

        }

    }else if(to_add == "action-button"){

        if(this.childNodes[0] != undefined && this.childNodes[0].classList.contains("scms-centred-element")){
            var e = this.childNodes[0];
            var button = $(e).child('button').addClass('scms-simple-action-button').html('Click here');
            button.get(0).setAttribute('data-scms-action-click', "");
             must_reload = true;
            $('#scms-get-json').click();

        }

    }else if(to_add == "landing-image"){

        if(this.childNodes[0] != undefined && this.childNodes[0].classList.contains("scms-centred-element")){
             var div = document.createElement('div');
            $(div).addClass('scms-landing-image');
            div.style.height = "300px";
            div.style.backgroundImage = "url()";
            $(div).child('span').html('contenu');
             var idiv = $(div).child('div').addClass('scms-centred-element');    
            this.parentElement.insertBefore(div, this);
           
            must_reload = true;
            $('#scms-get-json').click();

        }

    }else if(to_add.indexOf('scms-extension-') == 0){

        var id = to_add.replace('scms-extension-', "");

        var mod = modules[id];
        var element = this;
        eval(mod["js_code_builder"]);

    }



    to_add = "";

});


function scms_edit_action (element){

    var action = element.getAttribute("data-scms-action-click");

    var end_action = prompt("Action à effectuer : ", action);

    if(end_action != null){

        element.setAttribute("data-scms-action-click", end_action);

    }

    var edit_text = confirm("Voulez vous éditer le texte présent sur le bouton ?");

    if(edit_text == true){

        var bt = prompt("texte présent sur le bouton", element.innerText);

        if(bt != null){

            element.innerText = bt;

        }

    }

}


</script>
<?php } ?>