
//=============================================================================== AJAX LIB and GENERAL FUNCTIONS

var XMLHttpFactories = [
	function () {return new XMLHttpRequest()},//este es el standard
	function () {return new ActiveXObject("Msxml2.XMLHTTP")},
	function () {return new ActiveXObject("Msxml3.XMLHTTP")},
	function () {return new ActiveXObject("Microsoft.XMLHTTP")}
]; // end XMLHttpFactories

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
}// end createXMLHTTPObject


var xhr;
function ajax(metodo,url, unaFuncion, mensaje, async) {
	
	xhr = createXMLHTTPObject();
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
}// end ajax

function vardump(){

	console.log(this.responseText);
}//end vardump

function redirect(){

	setTimeout("location.href='index.php'", 1);
}//end redirect

function byid(s){

	return document.getElementById(s);
}//end byid

function create(s){

	return document.createElement(s);
}//end create

function getClass(matchClass) {
    var elems = document.getElementsByTagName('*'), i;
    for (i in elems) {
        if((' ' + elems[i].className + ' ').indexOf(' ' + matchClass + ' ') > -1) {
            elems[i].style.display = 'block';
        }
    }
}//end getClass


//=============================================================================== LOGIN FUNCTIONS

var source; //variable para poder hacer el switch en print user menu 

function printUserMenu(){

	var html = this.responseText;
 	//lo que hace este try parsear los errores, si no hay errores falla y va al catch e imprime el contenido
 	try 
 	{
 		var errores = JSON.parse(this.responseText);
 		var err = create('p');
 		err.className = 'error';
 		for(error in errores)
 		{
 			var p = '<strong>'+error+'</strong> '+errores[error];
 		}
 		err.innerHTML = p;
 		switch(source) //switch para ver donde imprimir el error
 		{
 			case 'log':
 				byid('log-form').appendChild(err);
 				break;
 			case 'reg':
 				byid('reg-form').appendChild(err);
 				break;
 		}
 		
 		//document.body.insertBefore(err,document.body.firstChild);
 		
		//intervalo que borra el error - ver si es conveniente
 		setTimeout(function()
			{
				err.parentNode.removeChild(err);
			},3000)
 	}
 	catch(e)
 	{
		var wrap = byid('login-reg');
		//byid('logo-pet-magick').nextSibling
 		wrap.innerHTML = html;
 		//eval(byid('jslogout').innerHTML); 
 	}	 
}//end printUserMenu

function login(){

	byid('login').onclick = function(){ 
		//levanto los valores de los campos
		var email = byid('email-log').value;
		var pass = byid('password-log').value;
		var token = byid('token').value;

		//variable q pasa todo por post
		var vars = 'email='+email+'&password='+pass+'&token='+token;

		source = 'log';
		ajax('POST', 'ajax/login.php', printUserMenu, vars, true);
	}
}//end login

//=============================================================================== REGISTRATION FUNCTIONS

function reg(){
		
	byid('reg').onclick = function() {
		
		//levanto los valores de los campos
		var name = byid('name').value;
		var lastname = byid('lastname').value;
		var nickname = byid('nickname').value;
		var email = byid('email').value;
		var password = byid('password').value;
		var password2 = byid('password2').value;
		var rank = 1; // Ver q valores mandamos por aca
		var country = byid('country').value;
		var region = byid('region').value;
		var city = byid('city').value;
		var token = byid('token').value;

		//variable q pasa todo por post
		var vars = 'name='+name+'&lastname='+lastname+'&nickname='+nickname +'&email='+email+'&password='+password+
				   '&password2='+password2+'&rank='+rank +'&country='+country+'&region='+region+'&city='+city+'&token='+token;

		source = 'reg';
		ajax('POST', 'ajax/reg.php', printUserMenu, vars, true);
	}
}//end reg

var flag = 0; // showForms(), -- public --
function showForms(link, show, hide){
    
	byid(link).onclick = function()
	{
		if(flag == 0)
		{
			byid(show).style.display = "block";
			flag = 1;
		}	
		else
		{
			byid(show).style.display = "none";
			flag = 0;
		}

		//ESCONDO EL OTRO POR LAS DUDAS
		byid(hide).style.display = "none";
		flag=0;

		var over = true;

		byid(show).onmouseover = function ()
		{
			 over = true;
		}
		byid(show).onmouseout = function ()
		{
			over = false;	
		}
		
		document.body.onclick = function()
		{
			if(!over)
			{
				byid(show).style.display = "none";
				flag = 0;
			}
		}
	}
}//end showLogin

//============================= COMBO FUNCTIONS

function printRegions(){
	
	var html = this.responseText;
	var wrap = byid('region');
		wrap.innerHTML = html;
	var options = wrap.getElementsByTagName('option');
		
		if(options.length > 1){
			
			byid('region').style.display = 'block';// Ver pq no puedo hacer esto sobre e wrapper, como en regions....
		}
		else
		{
			byid('region').style.display = 'none';
		}
	var loading = byid('loading-location');
	loading.parentNode.removeChild(loading);
}//end printRegions

function printCities(){
	var html = this.responseText;
	var wrap = byid('city');
		wrap.innerHTML = html;
	var options = wrap.getElementsByTagName('option');
	console.log(options)
	if(options.length > 1){
		
		byid('city').style.display = 'block';// Ver pq no puedo hacer esto sobre e wrapper, como en regions....
	}
	var loading = byid('loading-location');
	loading.parentNode.removeChild(loading);
}//end printCities

function countriesCombo(){

	var country = byid('country');
	country.onchange = function()
	{
		byid('region-wrapper').style.display = 'block';
		var id = country.options[country.selectedIndex].value; 
		var vars = 'idCountry='+id;
		// VACIO EL SELECT DE CITY y lo oculto
		byid('city').innerHTML = '';
		byid('city').style.display = 'none';
		//le pongo el gif loading
		var loading = create('img');
		loading.src = 'img/loading.gif'; 
		loading.id='loading-location';
		byid('country-wrapper').appendChild(loading);
		ajax('GET', 'ajax/selectRegions.php?'+vars, printRegions, false, true);
	};
}//end countriesCombo

function regionsCombo(){
		
	var region = byid('region');
	region.onchange = function()
	{
		byid('city-wrapper').style.display = 'block';	
		var id = region.options[region.selectedIndex].value; 
		var vars = 'idRegion='+id;
		//le pongo el gif loading
		var loading = create('img');
		loading.src = 'img/loading.gif'; 
		loading.id='loading-location';
		byid('region-wrapper').appendChild(loading);
		ajax('GET', 'ajax/selectCities.php?'+vars, printCities, false, true);

	};
}//end regionsCombo


//=============================================================================== INBOX FUNCTIONS

var fromId; //ya no sé si debe ser publica ???

//Lo primero que hace es imprimir los encabezados (la lista de conversaciones) Le agregué a getHeaders.php una variable $_SESSION['last-header'] q guarda la fecha en que trajo los encabezados.
//A los li le pone como ID user-#ID (ej user-23) para despues borrarlos y subirlos en caso de que haya nuevos mensajes.
//Los onclick de los "a" de las conversaciones tienen un if, que se fija si hay alguna petición en curso por ajax. si hay, la cancelan. Hay q tener cuidado con esto por si hay otra petición por ajax ajena al chat, ya que esto lo cancelaría. Para esto lo que hice fue hacer publica la variable xhr de la funcion ajax()
//Hasta acá todo ok funciona y está hecho.
//
//Ahora, tiene q haber un bucle, que esté constantemente chequeando si hay mensajes nuevos. Tendria q haber una función (desde php) que chequeé si hay mensajes que hayan llegado después de la fecha q se guardo en sesión. ['last-header']
//Si encuentra que hay mensajes nuevos. habría que generar el/los encabezados de esos mensajes y actualizarlos (a través del id que le puse al li). y actualizar la fecha de $_SESSION['last-header'];
//Le agregué también una variable a getAllMessages $_SESSION['current-chat'] que guarda el id de la conversación abierta.
//Si el archivo q ejecuta el bucle encuentra mensajes nuevos, además de devolver los encabezados, tiene q tener un IF, que verifique si 'current-chat' existe, si existe debe evaluar si dentro de los mensajes recibidos existe alguno del usuario guardado en sesión. Si esto es así, devuelve el mensaje y lo actualiza en la conversación abierta. De lo contrario, no pasa nada, y solo se actualizan los encabezados.

//Todo lo planteado arriba está hecho, hay q testearlo bien. No testée nada solo probé una vez y listo

//El formulario de envío de mensajes tendria q mostrarse al abrir una conversación, con lo cual debería generarse al hacer click en el A.
//Una vez q hace click ahi se guarda en una variable publica el ID de ese usuario asi cuando se manda mensaje el usuario no tiene q completar nada.
//Por una cuestión de seguridad, conviene encriptar los id d usuario??? (de alguna forma q se pueda desencriptar después).
//Tengo mucho cagazo q todo lo q venimos haciendo hasta acá no ande en EXPLORER.

//TODO LO DE ARRIBA HECHO

//===================
//TO DO
//Para poder iniciar una conversación tendría q haber un boton q diga "new message". Ahi se abre una ventana modal y tenes el TO q sería el autocomplete con ajax. y el campo del mensaje.
//Algo q no pude resolver desde las consultas y creo q no se puede resolver es que si vos mandas un mensaje a alguien q nunca te mensajeaste, hasta q ese usr no te responde, ese mensaje no lo levantas desde ningun lado. Intenté hacer como fb que en en los encabezados tambien te muestra el mensaje q mandas vos. pero es imposible. para eso si necesitariamos la tabla "conversaciones" pero a esta altura me parece q es complicarla al pedo, con todo lo que ya avanzamos. Se me ocurre q para resolver ese bache se puede imprimir debajo de los encabezados, otros encabezados bajo el titulo "unanswered messages" o alguna gilada así, para q el tipo tenga acceso a esos mensajes. Pensé en enviados, pero ahi deberían aparecer todos y es alta japa. Pq habria q hacer todo el chat, pero a la inversa, creo estoy pensando asi en el aire.




function inbox(){

	ajax('GET', 'ajax/getHeaders.php', printHeaders, null, true);


	 byid('send-message').onclick = function(){
	 	//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
		if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
		{
			xhr.abort();
		}

	 	var vars = 'message='+byid('message').value;
	 	ajax('POST', 'ajax/sendMessage.php', printMessages, vars, true); // ejecuta printMessages para imprimir el mensaje q mando
	 	byid('message').value = '';
	 }
}//end inbox

function printHeaders(){

	//si no viene nada por arguments es q esta ejecutada por ajax
	if(arguments.length == 0)
	{
		var html = eval(this.responseText);	
	}
	else
	{
		var html = arguments[0];
	}
	var as;
	var lis;
	var title;
	var lines;
	var each;
	var eachName;
	var lastMsg;

	for(var i = 0; i < html.length; i++){

		 each =  html[i]['ID_USER'];
		 eachName =  html[i]['NAME'] + ' ' + html[i]['LASTNAME'] + ' (' + html[i]['NICKNAME'] + ')';
		 lastMsg =  html[i]['Messages'][0]['MESSAGE'];
		 //console.log(lastMsg);

		if(byid(each) === null){ 

	 		as = create('a');
	 		as.id = each; //revisar valor
	 		as.href = "?u="+each;
	 		lis = create('li');
	  		lis.id = 'user-'+each;
	  		if(html[i]['Messages'][0]['STATUS'] == 0)
	  			lis.className = 'msg-unread';

	  		title = create('span'); 
	  		title.innerHTML = eachName;
	  		caption = create('p');
	  		caption.innerHTML = lastMsg;

	  		as.appendChild(title);
	  		as.appendChild(caption);
	  		lis.appendChild(as);
	  		
	  		//byid('wrap-conversations').appendChild(lis);
	  		
	  		if(arguments.length==0)
	  		{
	  			byid('wrap-conversations').appendChild(lis);
	  		}
	  		else
	  		{
	  			byid('wrap-conversations').insertBefore(lis,arguments[1]);
	  		}

	  		byid(each).onclick = function(e)
	  		{
	  			//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
	  			if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
	  			{
	  				xhr.abort();
	  			}
		    	
		    	e.preventDefault();
		  		var index = this.href.indexOf('=');
		  		index ++;
		  		fromId = 'fromId=' + this.href.substr(index);
		  		//console.log(fromId);
		  		
		  		ajax('POST', 'ajax/getAllMessages.php', printMessages, fromId, true);
		  		byid('wrap-messages').innerHTML = ""; // borro el contenido del contenedor de los mensajes (hacer remove childs???)
		  		byid('write-message').style.display = "block";
		  		
		  	}
	  	}
	 }//end for

	 //empiezo a chequear si hay nuevos mensajes
	 refreshInbox();
}//end printHeaders

function printMessages(){

	//si no tiene argumentos viene por ajax
	if(arguments.length == 0)
		var html = eval(this.responseText);
	else
		var html = arguments[0];

	// valido si la respuesta es undefined es pq cancelo el request o vino vacía.
	if(html == undefined) return;
	for(var i = 0; i < html.length; i++)
	{
		lines = create('li');
		lines.className = html[i]['Users']['ID_USER'];
		lines.innerHTML = '<strong>' + html[i]['Users']['NAME'] + ' ' + html[i]['Users']['LASTNAME'] + ' (' + html[i]['Users']['NICKNAME'] + ')</strong><span> | ' + html[i]['DATE'] + '</span><p>' + html[i]['MESSAGE'] + '</p>';
		
		byid('wrap-messages').appendChild(lines);
	}//end for
}//end printMessages



function refreshInbox()
{
				
	if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
	{
		//hay una petición en curso;
		setTimeout(refreshInbox,2000);		
	}
	else
	{
		//ok ejecuta denuevo
		ajax('POST', 'ajax/checkNewMsgs.php', printUpdates, fromId, true);	
		setTimeout(refreshInbox,2000);
	}
		
};


function printUpdates()
{
	//console.log(this.responseText);
	var html = eval(this.responseText);
	//console.log(html[0]);
	if(html[0] == null)
	{
		return;
	}
	else
	{
		//si hay busco los encabezados impresos y los borro con try catch, porque si es la primera vez q mandan mensaje no lo va a encontrar
		for(var i = 0; i < html[0].length; i++)
		{	
			try
			{
				var id = 'user-' + html[0][i]['ID_USER'];
				var li = byid(id);
				li.parentNode.removeChild(li);
			}
			catch(e)
			{
				continue;
			}
		}
		
		//tomo como referencia el primer LI (header) q hay actualmente, asi inserto arriba de ese
		var fchild = byid('wrap-conversations').firstChild;

		//imprimo los encabezados pasandole como referencia lo q tiene q imprimir y a partir de donde (ver función para ver los cambios)
		printHeaders(html[0],fchild);

	}

	if(html[1] == null)
	{
		return;
	}
	else
	{
		printMessages(html[1]);
	}
}
	



















//=============================================================================== BIN



/*
function getNewMessages()
{
	if(this.readyState == undefined || this.readyState == 4)
		{
			//console.log('entrooo');
			//fromId es publica y esta definida en el onclick del remitente			
			ajax('POST', 'ajax/getNewMessages.php', printMessages, fromId, true);
		}
	else
		console.log('esperando');
	
	msgInterval = setTimeout(getNewMessages, 1000);

}
*/



/*
function printMessages(){

	
	var html = eval(this.responseText);
    for(var i = 0; i < html.length; i++){

		  			lines = create('li');
			  		lines.className = html[i]['Users']['ID_USER'];
			  		lines.innerHTML = '<strong>From: ' + html[i]['Users']['NAME']; + '</strong><br> message: ' + html[i]['MESSAGE'] + '<br> Fecha: ' + html[i]['DATE'];
			   		lines.style.display = 'none';
			   		var ul = byid(html[i]['Users']['ID_USER']);
			   		ul.appendChild(lines);

			   		if(lines.className == ul.id){ 
			  		 ul.appendChild(lines);
				   }	

			   		getClass(html[i]['Users']['ID_USER']);

			   	}//end for
}
*/







/*

http://new-bamboo.co.uk/blog/2012/01/10/ridiculously-simple-ajax-uploads-with-formdata

var form = document.getElementById('form');
var fileInput = document.getElementById('file');


 form.onsubmit = function() {
     var file = fileInput.files[0];
     var formData = new FormData(form);
    	 formData.append('file', file);
    	 ajax('POST', 'ajax/insertar.php', formData, false, true);
 }
*/




/*
function upload_img(){

	byid('upload').onclick = function(){ 
		//levanto los valores de los campos
		var file = byid('file').name;
		var caption = byid('caption').value;

		var vars = 'img='+file+'&caption='+caption;
		
		ajax('POST', 'ajax/insertar.php', vardump, vars, true);
	}
}//end logi
*/





	/*
Estructura del json q trae
[
{
	"ID_MESSAGE":"1",
	"FROM_USER_ID":"4",
	"TO_USER_ID":"5",
	"SUBJECT":"Hola",
	"MESSAGE":"Hola como estas",
	"STATUS":"9",
	"DATE":"2013-12-06",
	"Users":
	{
		"ID_USER":"4",
		"NAME":"luis",
		"LASTNAME":"miguel",
		"NICKNAME":null,
		"EMAIL":null,
		"PASSWORD":null,
		"ABOUT":null,
		"COUNTRY_ID":null,
		"REGION_ID":null,
		"CITY_ID":null,
		"PIC_ID":null,
		"ALBUM_ID":null,
		"RANK":null,
		"TOKEN":null
	}
}
] 

	*/
























/* NO VA CON EL POPUP
function printReg(){

	var html = this.responseText;
	var wrap = byid('login-reg');
		wrap.innerHTML = html;
		eval(byid('jsreg').innerHTML); 	
}//end printReg
*/


/* NO LA USO CON LA VENTANA POP UP
function printLogin(){

	var html = this.responseText;
	var wrap = byid('login-reg');
		wrap.innerHTML = html;
		eval(byid('jslogin').innerHTML); 	
}//end printReg
*/
