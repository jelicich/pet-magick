<div id="wrap">
	<div id="formulario">
		<h1>Registrese</h1>
		<form method='post'>
			<label for='nombre'>Nombre</label>
			<input type='text' id='nombre' name='nombre'/>

			<label for='apellido'>Apellido</label>
			<input type='text' id='apellido' name='apellido'/>

			<label for='mail'>e-Mail</label>
			<input type='text' id='mail' name='mail'/>

			<label for='password'>Password</label>
			<input type='password' id='password' name='password'/>		

			<label for='password2'>Repita Password</label>
			<input type='password' id='password2' name='password2'/>		

			<input type='button' id='registrar' value='Registrar'/>
		</form>
	</div>
</div>


<script type="text/javascript" id="scfr">


document.getElementById('registrar').onclick = function(){

	var n = document.getElementById('nombre').value;
	var a = document.getElementById('apellido').value;
	var m = document.getElementById('mail').value;
	var p = document.getElementById('password').value;
	var p2= document.getElementById('password2').value;

	var vars = 'nombre='+n+'&apellido='+a+'&mail='+m+'&password='+p+'&password2='+p2;
	ajax('POST', 'ajax/registrar.php', imprimirLogin, vars, true);
}



//libreria

function imprimirLogin()
{
	//eval('var html = ' + this.responseText + ';');
 	var html = this.responseText;
 	try 
 	{
 		var errores = JSON.parse(this.responseText);
 		var err = document.createElement('p');
 		err.className = 'error';
 		var p='<strong>Error:</strong><br>';
		for(error in errores)
 		{
 			if(typeof errores[error] == 'object')
 			{
 				p += '#'+error+' ';
 				for(var i=0; i < errores[error].length; i++)
 				{
 					p+= errores[error][i]+'<br>';
 				} 
 			}
 			else
 				p += '#'+error+' '+errores[error];
 		}	
		
 		err.innerHTML = p;
 		document.body.insertBefore(err,document.body.firstChild);
 		setTimeout(function()
			{
				err.parentNode.removeChild(err);
			},3000)	
 	}
 	catch(e)
 	{
 		var wrap = document.getElementById('wrap');
 		wrap.innerHTML = '<p class="ok">Registro exitoso</p>' + html;
 		eval(document.getElementById('scli').innerHTML);
 	}
 	
 	
 	//para que pueda ejecutar el codigo nuevo que cargue en la otra pagina con el responsetext
 	
 	//onLoadChat();
}


</script>