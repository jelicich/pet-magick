<?php session_start();?>

<?php $_SESSION['token'] = sha1(uniqid()); ?>

<div id="wrap">
	<div id="formulario">
		<h1>Bienvenido al chat</h1>
		<form method='post'>
			<label for='usuario'>Usuario</label>
			<input type='text' id='usuario' name='usuario'/>

			<label for='password'>Password</label>
			<input type='password' id='password' name='password'/>

			<input type='hidden' name='token' id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />
			<input type='button' id='entrar' value='Entrar'/>
		</form>

		<p>No tiene cuenta? <a id="registrarse" href="#">Registrese</a></p>
	</div>
</div>

<script type="text/javascript" id="scli">


	//PARA LOGUEARSE 
var d= document;
document.getElementById('entrar').onclick = function() {
	//levanto los valores de los campos
	var usr = d.getElementById('usuario').value;
	var pass = d.getElementById('password').value;
	var token = d.getElementById('token').value;

	//variable q pasa todo por post
	var vars = 'usuario='+usr+'&password='+pass+'&token='+token;

	ajax('POST', 'ajax/login.php', imprimirChat, vars, true);
} 	

document.getElementById('registrarse').onclick = function(){
	ajax('POST', 'ajax/loadreg.php', imprimirRegistrar, null, true); 
}

//libreria

function imprimirChat()
{
	//eval('var html = ' + this.responseText + ';');
 	var html = this.responseText;
 	try 
 	{
 		var errores = JSON.parse(this.responseText);
 		var err = document.createElement('p');
 		err.className = 'error';
 		for(error in errores)
 		{
 			var p = '<strong>Error: </strong> #'+error+' '+errores[error];
 		}
 		err.innerHTML = p
 		document.body.insertBefore(err,document.body.firstChild);
 		setTimeout(function()
			{
				err.parentNode.removeChild(err);
			},3000)
 	}
 	catch(e)
 	{
		var wrap = document.getElementById('wrap');
 		wrap.innerHTML = html;
 		eval(document.getElementById('scfc').innerHTML); 		
 	}
 	
 	
 	//para que pueda ejecutar el codigo nuevo que cargue en la otra pagina con el responsetext
 	
 	//onLoadChat();
}


function imprimirRegistrar()
{
	javascript:void(0);
	var html = this.responseText;
	var wrap = document.getElementById('wrap');
	wrap.innerHTML = html;	
	eval(document.getElementById('scfr').innerHTML);
}

</script>