<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header" tabindex="-1">
    
    </div>
    <div class="code-editor-colors" tabindex="-1">

    </div>
    <div class="code-editor" contenteditable="true" tabindex="1">

    </div>
    <script src="../scms-core/extjs.js"></script>
    <script>
        var e = $(".code-editor").get(0);
        e.oninput = function () {
            var text = e.innerText;

            text = text.replace(/<(.[^>]*)/g, "&lt;<span class='html-el'>$1</span>");           

            text = text.replace(/(\n|\r)/g, "<br />");
            text = text.replace(/(\r\n)/g, "<br />");

            $(".code-editor-colors").html(text);
        }
        e.onkeyup = e.oninput;
        e.onkeydown = function (event){
            if(event.which == 9){
                e.focus();

                if(e.innerText == "!"){
                    
                    e.innerText = '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <meta http-equiv="X-UA-Compatible" content="ie=edge">\n    <title>Document</title>\n</head>\n<body> \n    \n    \n</body>\n</html>';

                }

                return false;
            }
        }
    </script>
</body>
</html>