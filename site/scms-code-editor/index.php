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
        var span = "x~~~~--SimonLoirCodeEditor-Span-Element";
        var span_end = "x~~~~--SimonLoirCodeEditor-Span-Elements-Close";
        var e = $(".code-editor").get(0);
        e.oninput = function () {
            var text = e.innerText;

            /*text = text.replace(/<\?php((.|\n)[^\?]*)\?>$/gm, function (m, p1){
                var php = p1;
                
                php = code_php(php);


                return span + " class='php-el'>&lt;?phpx~~~~--SimonLoirCodeEditor-Span-Elements-Close>" + php + "x~~~~--SimonLoirCodeEditor-Span-Element class='php-el'>?&gt;x~~~~--SimonLoirCodeEditor-Span-Elements-Close>"
            
            });*/

            text = text.replace(/<(.[^>]*)/g, function (m, p1){
                
                if(p1.indexOf("?php") != 0 || p1.indexOf("?", p1.length - 1) != p1.length - 1){
                    p1 = p1.replace(/(.[^ ]*)="(.[^"]*)"/g,'<span class="html-attribute"> $1</span><span class="no-color">=</span><span class="string-color">"$2"</span>');
                    return "&lt;<span class='html-el'>" + p1 + "</span>";
                }else{
                    return "&lt;<span class=''>" + code_php(p1) + "</span>";
                }

            });
     
            text = text.replace(/x~~~~--SimonLoirCodeEditor-Span-Elements-Close/g, "</span");
            text = text.replace(/x~~~~--SimonLoirCodeEditor-Span-Element/g, "<span");
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

                }else{
                    

                }

                return false;
            }
        }

        function code_php(code){
            code = code.replace(/function (.*)\((.*)\)/gm, function (m, p1, p2) {
                return span + ' class="php-el">function' + span_end + "> " + span + ' class="php-function">' + p1 + span_end + ">(" + p2 + ")";
            });
            return code;
        }

    </script>
</body>
</html>