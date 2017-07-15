<?php 
session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="extjs.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet"> 
</head>
<body>
<textarea id="result" style="width:100%;height: 100%;background: rgba(0,0,0,0.97);color:#EEE;position: fixed;top:0;left:0;right: 0;bottom:0;border:none;padding:15px;font-family: 'Source Code Pro', monospace;font-size: 16px;" ></textarea>
<input id="more" style="background: transparent;color:#EEE;position: fixed;right: 0;bottom:0;border:none;font-family: 'Source Code Pro', monospace;font-size: 10px;text-align: right;" value="" disabled>
</body>
<script type="text/javascript">
var user = {
	
	<?php 
	if (isset($_SESSION["scms-global-admin-" . sha1(realpath("../."))])) {
		echo 'li: true,';
		echo "name: \"".$_SESSION["scms-global-admin-" . sha1(realpath("../."))]."\"";
	}else{	
		echo 'li: false,';
		echo 'name: "guest"';
	}
	 ?>
}
 $('#result').node.value = "TERMINAL PHPTERM"
 + "\nCréé par Simon Loir - projet open source"
 + "\nWrite help to see all commands"
 "\n";

 var line_command = lc();
 function lc(){
 	if (user.li == true) {
 		var username = user.name;
 	}else{
 		var username = "guest";
 	}
 	return "\n" + username + "::<?php echo $_SERVER['SERVER_ADDR'];?> ~  $ ";
 }
var __terminal_last_value = $('#result').node.value;
__terminal_last_value += line_command;
$('#result').node.focus();
$('#result').node.value = __terminal_last_value
var textarea = $('#result').node;



cpos($('#result').node, $('#result').node.value.length);

function __continue(){
	line_command = lc()
	$('#result').node.value += line_command;
	 __terminal_last_value = $('#result').node.value;
	cpos($('#result').node, $('#result').node.value.length);
	textarea.scrollTop = textarea.scrollHeight;
}
$('#result').click(function (){
	cpos($('#result').node, $('#result').node.value.length);
	textarea.scrollTop = textarea.scrollHeight + 100;
});

$('#result').node.onkeydown = function (event) {

	if (event.keyCode == 13) {
		event.preventDefault();

		var real_command = $(this).node.value.replace(__terminal_last_value,"");

		if (real_command == "help") {
			$('#result').node.value = $('#result').node.value + "\n\n**** HELP ****\n\n"
			+
			"\nu {user}       adresse email utilisée lors de l'installation du site"
			+
			"\np {password}   définir le mot de passe et se connecter"
			+
			"\nhelp           afficher l'aide"
			+"\n\n"
			;
			__continue();
		}else if (real_command == "clear") {
			$('#result').node.value = "";
			__continue();
		}else if (real_command == "") {
			__continue();
		}else if (real_command == "gui") {
			prin("Redirecting to GUI ");

			window.location.href = "../scms-admin";

			__continue();
		}else if (real_command.indexOf("u ") == 0) {
			$('#result').node.value = $('#result').node.value + "\nusername :" +  real_command.replace("u ", "") + "\nUn mot de passe est requis. Utilisez la commande p {password}";
			user.name = real_command.replace("u ", "");
			__continue();
		}else if (real_command.indexOf("p ") == 0) {
			
			var password =  real_command.replace("p ", "");
			
			AR.POST("login.php", {
				password:  password,
				user:user.name
			},function(data) {
				if (data == "ok") {
					user.li = true;
				}else{
					print('\n' + data);
					user.li = false;
				}
				__continue();
			});

			
		}else if (real_command.indexOf("root ") == 0 || real_command.indexOf("sudo ") == 0) {
			if (real_command.indexOf("root ") == 0){
				var real_command =  real_command.replace("root ", "");
			}else{
				var real_command =  real_command.replace("sudo ", "");
			}
			
			if (user.li == true) {
				if (real_command == "help") {
					print('\n---      HELP      ---\n');

					print('sudo or root + \n');

					prin("install [packages] [--all]");

					prin('');
					__continue();
				}else if (real_command.indexOf("install ") == 0) {

					var to_install = real_command.replace('install ', "");

					if(to_install == "packages --all"){

						AR.GET('../scms-modules/install.php', function (data) {

							prin("server_response : " + data);

							prin('');

							__continue();

						});

					}

				}else if (real_command.indexOf("build ") == 0) {

					var to_install = real_command.replace('build ', "");

					if(to_install == "packages --all"){

						AR.GET('../scms-modules/module_to_installer.php', function (data) {

							prin("server_response : " + data);

							prin('');

							__continue();

						});

					}

				}else if (real_command.indexOf("maintenance ") == 0) {

					var doit = real_command.replace('maintenance ', "");

					if(doit == "true"){

						//makes file

					}else{

						//destroys file

					}

				}else{
					print('\nError : incorrect command or filename');
					__continue();
				}
			}else{
				print('\nuse u {username} to log in');
				__continue();
			}
			

			

			
		}else if (real_command == "sysinfos") {
			$('#result').node.value = $('#result').node.value + "\n****System informations**** \n\nPHP version : " + "<?php echo phpversion(); ?>"
			+"\nNom du serveur : " + "<?php echo $_SERVER['SERVER_NAME']; ?>";
			print('\nCurrent user :' + user.name);
			__continue();

		}else if (real_command == "reboot") {
			$('#more').node.value = "rebooting ..."
			setTimeout(function function_name() {
				window.location.reload();
			}, 1500)
		}else if (real_command == "-r") {
			$('#more').node.value = "rebooting ..."
			setTimeout(function function_name() {
				window.location.reload();
			}, 1500)
		}else if (real_command == "-q" || real_command == "-e") {
			$('#more').node.value = "exit ..."
			setTimeout(function function_name() {
				window.close();
				__continue();
			}, 500)
		}else{
			$('#result').node.value = $('#result').node.value + "\nIncorrect command : " + real_command + "\n" ;
			__continue();
		}

	}

	if (event.keyCode == 8) {
		if ($(this).node.value == __terminal_last_value) {
			event.preventDefault();
		}
	}

}


function cpos(input, start, end) {
    if (arguments.length < 3) end = start;
    if ("selectionStart" in input) {
        setTimeout(function() {
            input.selectionStart = start;
            input.selectionEnd = end;
        }, 1);
    }
    else if (input.createTextRange) {
        var rng = input.createTextRange();
        rng.moveStart("character", start);
        rng.collapse();
        rng.moveEnd("character", end - start);
        rng.select();
    }
}

function print(text){
	$('#result').node.value = $('#result').node.value + text;
}
function prin(text){
	print("\n" + text);
}
</script>
</html>
