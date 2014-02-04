<div id="wrap">
	<div id='contenedor'>
		<div id="escribir">
			<form method='post'>
				<div>
					<h2>De <?php echo $_SESSION['nombre']; ?> </h2>
					<input type='button' id='out' value='Salir'/>	
				</div>

				<label for='to'>Para</label>
				<input type='text' id='to' name='to'/>

				<label for='msg'>Mensaje</label>
				<textarea id='msg' name='msg'></textarea>

				<input type='button' id='enviar' value='Enviar'/>
			</form>
		</div>
		
		<div id='vermsg'>
			<h2>Mensajes</h2>
		</div>
	</div>
</div>
<script type='text/javascript' id="scfc">
traerMsg();
var d= document;
document.getElementById('enviar').onclick = function() {
	//levanto los valores de los campos
	var to = d.getElementById('to').value;
	var msg = d.getElementById('msg').value;

	//variable q pasa todo por post
	var vars = 'to='+to+'&msg='+msg;

	ajax('POST', 'ajax/procesar.php', verErrores, vars, true);
}

document.getElementById('out').onclick = function(){
	clearTimeout(to);
	ajax('POST', 'ajax/logout.php', imprimirLogin, null, true);	
}

/*
document.getElementById('ver').onclick = function() {
	traerMsg();
}
*/

// lib

function traerMsg()
{
	if(this.readyState == undefined || this.readyState == 4)
		{
			//console.log('entrooo');
			//var usr = document.getElementById('usr').value;
			ajax('GET', 'ajax/vermsg.php', verMsg, null, true);
		}
	else
		console.log('esperando');
	
	to = setTimeout(traerMsg, 5000);
}

function verMsg()
{
	var winmsg = document.getElementById('vermsg');
	eval('var mensajes = '+this.responseText+';');
//	var imp="";
	for(var i = 0; i < mensajes.length; i++)
	{
		console.log(mensajes[i]);
		//var imp='Mensaje: ';
		/*
		for( var llave in mensajes[i] )
		{
			imp+=mensajes[i][llave]+" | ";
		}
		*/
		imp = document.createElement('p');
		imp.className = 'msgR';
		imp.innerHTML = "De: " + mensajes[i]['Usuarios']['MAIL'] + "<br> Fecha: " + mensajes[i]['FECHA'] + "<br> Mensaje: " + mensajes[i]['MENSAJE'];
		winmsg.appendChild(imp);
	}
	console.log(this.readyState);
}

function imprimirLogin()
{
	var html = this.responseText;
 	var wrap = document.getElementById('wrap');
 	wrap.innerHTML = html;
 	
 	//para que pueda ejecutar el codigo nuevo que cargue en la otra pagina con el responsetext
 	eval(document.getElementById('scli').innerHTML)
}

function verErrores()
{
	try
	{
		var html = JSON.parse(this.responseText);
	}
	catch(e)
	{
		var html = "";
	}
	
	if(html == '' || html == undefined || html == null)
	{
		//muestro el mensaje que mando
		var vm = document.getElementById('vermsg');
		imp = document.createElement('p');
		imp.className = 'msgE';
		imp.innerHTML = "Para: " + document.getElementById('to').value + "<br> Fecha: " + dateNow() + "<br> Mensaje: " + document.getElementById('msg').value;
		document.getElementById('msg').value = '';	
		vm.appendChild(imp);
		return;
	}
		
	else
	{
		var diverr = document.createElement('p');
		diverr.className = 'error';
		var cont = '<strong>Error:</strong><br>';
		for(var error in html)
		{
			cont += '#'+error+' ';
			if(typeof html[error] == 'string')
			{
				cont += html[error];
			}
			else
			{
				for(var i = 0; i<html[error].length; i++)
				{
					cont += html[error][i];
				}
			}
			cont += '<br>';
			//console.log('error '+error);
			//console.log(typeof html[error]);
			//console.log('valor '+html[error]);
		}
		diverr.innerHTML = cont;
		document.body.insertBefore(diverr,document.body.firstChild);
		setTimeout(function()
			{
				diverr.parentNode.removeChild(diverr);
			},3000)
	}
}

function dateNow () 
{
  now = new Date();
  year = "" + now.getFullYear();
  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}

</script>