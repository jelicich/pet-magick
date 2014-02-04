<?php session_start();?>
<html>
<head>
	<title>form chat</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css"/>
	

<script type="text/javascript">
var XMLHttpFactories = [
	function () {return new XMLHttpRequest()},//este es el standard
	function () {return new ActiveXObject("Msxml2.XMLHTTP")},
	function () {return new ActiveXObject("Msxml3.XMLHTTP")},
	function () {return new ActiveXObject("Microsoft.XMLHTTP")}
];

function createXMLHTTPObject() {
	var xmlhttp = false;
	for (var i=0;i<XMLHttpFactories.length;i++) {
		try {
			xmlhttp = XMLHttpFactories[i]();
		}
		catch (e) {
			continue;
		}
		break;
	}
	return xmlhttp;
}

function ajax(metodo,url, unaFuncion, mensaje, async) {
	//hacer una funcion
	var xhr = createXMLHTTPObject();
	xhr.open(metodo, url, async);
	if (metodo ==  'POST'){
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	}
	
	xhr.onreadystatechange = function () {
		console.log(new Date(),  this.readyState);
		if (this.readyState!=4 ) {
			//console.log('esperando');
		} else {
			unaFuncion.call(xhr);
		}
	}
	xhr.send(mensaje);
	///fin funcion
}
//modificar desde aqui!!


/*
miFuncion = function() {
 		var cantidad = parseInt(this.responseText);
		if (cantidad> 0) {
			console.log('hacer otra peticion');
			
			ajax('GET', 'mensajesNuevosAjax.php?cantidad='+cantidad, escribirMensajes, null, true);
		}
		document.getElementById('dos').value = this.responseText;
}

escribirMensajes = function() {
	console.log(this.responseText);
	//mensajes = [{"text":"hola 0","fecha":"2013-06-12 03:04:15"},{"text":"hola 1","fecha":"2013-06-12 03:04:15"},{"text":"hola 2","fecha":"2013-06-12 03:04:15"}]
	var mensajes = eval(this.responseText);
	
	for (var i=0; i<mensajes.length; i++) {
		var m = mensajes[i];
		var d = document.createElement('div');
		d.innerHTML = m.text+'<span>'+m.fecha+'</span>';
		document.body.appendChild(d);
	}
}
*/

vardump = function() {
	console.log(this.responseText);
}



/*

// chatttttt ---------------------------


//para ver los msgs
function verMsg(){
	var winmsg = document.getElementById('vermsg');
	eval('var mensajes = '+this.responseText+';');
//	var imp="";
	for(var i = 0; i < mensajes.length; i++)
	{
		console.log(mensajes[i]);
		
		imp = document.createElement('p');
		imp.innerHTML = "De: " + mensajes[i]['Usuarios']['MAIL'] + "<br> Fecha: " + mensajes[i]['FECHA'] + "<br> Mensaje: " + mensajes[i]['MENSAJE'];
		winmsg.appendChild(imp);
	}
	console.log(this.readyState);
}

function traerMsg(){
	if(this.readyState == undefined || this.readyState == 4)
		{
			//console.log('entrooo');
			var usr = document.getElementById('usr').value;
			ajax('GET', 'ajax/vermsg.php', verMsg, null, true);
		}
	else
		console.log('esperando');
	
	setTimeout(traerMsg, 5000);
}

function onLoadChat()
{
	var d= document;
	document.getElementById('enviar').onclick = function() {
		//levanto los valores de los campos
		var to = d.getElementById('to').value;
		var msg = d.getElementById('msg').value;

		//variable q pasa todo por post
		var vars = 'to='+to+'&msg='+msg;

		ajax('POST', 'ajax/procesar.php', vardump, vars, true);
	}

	document.getElementById('ver').onclick = function() {
		traerMsg();
	}
}

function imprimirHTML()
{
	//eval('var html = ' + this.responseText + ';');
 	var html = this.responseText;
 	var wrap = document.getElementById('wrap');
 	wrap.innerHTML = html;
 	
 	onLoadChat();
}


window.onload=function() {
	
 //-------------------------------------------------------------------

 	//PARA LOGUEARSE (index.html)
	var d= document;
	document.getElementById('entrar').onclick = function() {
		//levanto los valores de los campos
		var usr = d.getElementById('usuario').value;
		var pass = d.getElementById('password').value;

		//variable q pasa todo por post
		var vars = 'usuario='+usr+'&password='+pass;

		ajax('POST', 'ajax/login.php', imprimirHTML, vars, true);
	} 	
}

*/
</script>


</head>
<body>
<?php 
	//session_destroy();
	if(isset($_SESSION['token']) && isset($_SESSION['nombre']))
	{
		include_once 'templates/formchat.php';
	}
	else
	{
		include_once 'templates/formlogin.php';
	}
?>

<!--	
	<form method='post'>
		<label for='desti'>To</label>
		<input type='text' id='desti' name='desti'/>

		<label for='remi'>From</label>
		<input type='text' id='remi' name='remi'/>

		<label for='msg'>Mensaje</label>
		<textarea id='msg' name='msg'></textarea>

		<input type='button' id='enviar' value='Enviar'/>
	</form>

	<h2>Ver mensajes</h2>
	<label for="usr">Usuario</label>
	<input type="text" name="usr" id="usr"/>
	<input type='button' id='ver' value='Ver'/>
	<div id="vermsg">
	</div>
-->
</body>
</html>