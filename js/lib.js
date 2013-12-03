//============== LIBRERIA

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


function vardump() 
{
	console.log(this.responseText);
}

function redirect()
{
	setTimeout("location.href='index.php'", 1);
}

function byid(s)
{
	
	 return document.getElementById(s);
}


//=============================================================== 



//============================= LOGIN FUNCTIONS

function printUserMenu()
{
	//eval('var html = ' + this.responseText + ';');
 	var html = this.responseText;
 	//lo que hace este try parsear los errores, si no hay errores falla y va al catch e imprime el contenido
 	try 
 	{
 		var errores = JSON.parse(this.responseText);
 		var err = document.createElement('p');
 		err.className = 'error';
 		for(error in errores)
 		{
 			var p = '<strong>'+error+'</strong> '+errores[error];
 		}
 		err.innerHTML = p;
 		//ESTILO PARA VER Q ANDE NOMAS; BORRAR Y DARLE ESTILO CON CSS
 		err.style.position = "absolute";
 		err.style.zIndex = "22222";
 		document.body.insertBefore(err,document.body.firstChild);
 		
		//intervalo que borra el error - ver si es conveniente
 		setTimeout(function()
			{
				err.parentNode.removeChild(err);
			},3000)
 	}
 	catch(e)
 	{
		var wrap = byid('user-login');
 		wrap.innerHTML = html;
 		eval(byid('jslogout').innerHTML); 	//esta linea le hace un eval a la etiqueta script q trae el archivo q se carga	
 	}	 	
 	
 	//para que pueda ejecutar el codigo nuevo que cargue en la otra pagina con el responsetext
 	
 	//onLoadChat();
}//end printUserMenu


function login(){

	//levanto los valores de los campos
	var email = byid('email').value;
	var pass = byid('password').value;
	var token = byid('token').value;

	//variable q pasa todo por post
	var vars = 'email='+email+'&password='+pass+'&token='+token;

	ajax('POST', 'ajax/login.php', printUserMenu, vars, true);

}//end login


//============================= REGISTRATION FUNCTIONS

function printReg(){

	var html = this.responseText;
	var wrap = byid('user-login');
		wrap.innerHTML = html;
		eval(byid('jsreg').innerHTML); 	
}//end printReg



function reg(){
		
		//levanto los valores de los campos
		var name = byid('name').value;
		var lastname = byid('lastname').value;
		var nickname = byid('nickname').value;
		var email = byid('email').value;
		var password = byid('password').value;
		var password2 = byid('password2').value;
		var rank = 1;
		//var country = byid('country').value;
		var city = byid('city').value;
		var token = byid('token').value;

		//variable q pasa todo por post
		var vars = 'name='+name+'&lastname='+lastname+'&nickname='+nickname +'&email='+email+'&password='+password+
				   '&password2='+password2+'&rank='+rank +'&city='+city+'&token='+token;

		ajax('POST', 'ajax/reg.php', printUserMenu, vars, true);

}//end reg

