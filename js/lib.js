
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

var xhr; // ajax(), -- public --
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

function whilst(s){
	while (s.hasChildNodes()){
	  s.removeChild(s.firstChild);
	}
}//end whilst

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
		whilst(byid('city'));
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


// =============================================================================== INBOX FUNCTIONS

// PENDIENTE
//----------

//Logueo en todos los navegadores
//Agregar CASCADE a la tabla users

//CUANDO CREO MENSAJE
//abrir el chat correspondiente y agregarlo a la lista
//crear header 
//o agregarlo al header segun corresponda...
//Eliminar mensajes

//Maqueta (crudo)

var fromId;
var flagNM = 0; 

function inbox(){

	 ajax('GET', 'ajax/getHeaders.php', printHeaders, null, true);

	 // =========== New messages
	 byid('new-message').onclick = function(){

	 		//whilst(byid('wrap-messages')); 
	 		byid('inputTo').style.display = "block"; // ver como evitar esta linea ya q el html es blck por default
		 	byid('write-message').style.display = 'block';
	 }

	 // ===========  Submit messages
	 byid('send-message').onclick = function(){
	 	//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
		if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
		{
			xhr.abort();
		}

		var vars = 'to=' + byid('inputTo').value + '&message='+ byid('message').value; // Agrego to para enviar destinatario seleccionado.
	 	ajax('POST', 'ajax/sendMessage.php', printMessages, vars, true); // ejecuta printMessages para imprimir el mensaje q mando

	 	byid('inputTo').value = '';
	 	byid('message').value = '';

	 }
}//end inbox

function printHeaders(){

	//si no viene nada por arguments es q esta ejecutada por ajax
	if(arguments.length == 0)
	{	
		//console.log(this.responseText);
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
		 lastMsg =  html[i]['Messages'][0]['MESSAGE'];
		 //console.log(lastMsg);

		if(byid(each) === null){ 

	 		as = create('a');
	 		as.id = each; //revisar valor
	 		as.href = "?u="+ each;
	 		lis = create('li');
	  		lis.id = 'user-'+ each;
	  		if(html[i]['Messages'][0]['STATUS'] == 0)
	  			lis.className = 'msg-unread';

	  		title = create('span');
	  		title.className = 'from-user-name';
	  		title.innerHTML = eachName;
	  		caption = create('span');
	  		caption.className = 'preview-message';
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

		  		whilst(byid('wrap-messages')); 
		  		byid('inputTo').style.display = "none";
		  		byid('write-message').style.display = "block";
		  		flagNM = 1;

		  		if(this.parentNode.className == 'msg-unread')
		  		{
		  			this.parentNode.removeAttribute('class');
		  		}
		  	}
	  	}
	 }//end for
	 //empiezo a chequear si hay nuevos mensajes
	 refreshInbox();
}//end printHeaders

function printMessages(){

	//si no tiene argumentos viene por ajax
	if(arguments.length == 0){
		//console.log(this.responseText);
		var html = eval(this.responseText);

	}else{
		var html = arguments[0];
	}

	for(var i = 0; i < html.length; i++){

		lines = create('li');
		lines.className = html[i]['Users']['ID_USER'];
		lines.innerHTML = '<strong>' + html[i]['Users']['NAME'] + ' ' + html[i]['Users']['LASTNAME'] + ' (' + html[i]['Users']['NICKNAME'] + ')</strong><span> | ' + html[i]['DATE'] + '</span><p>' + html[i]['MESSAGE'] + '</p>';
		
		byid('wrap-messages').appendChild(lines);

	}//end for
}//end printMessages

function refreshInbox(){
				
	if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
	{
		//hay una petición en curso;
		setTimeout(refreshInbox,2000);		
	}
	else
	{	
		ajax('POST', 'ajax/checkNewMsgs.php', printUpdates, fromId, true);	
		setTimeout(refreshInbox,2000);
	}
}//end refreshInbox

function printUpdates(){
	//console.log(this.responseText);
	var html = eval(this.responseText);

	if(html == null || html[0] == null ) // html == null para q no tire error al ejecutar algunos eventos (refrescar, submit, etc)
	{
		return;

	}else{
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
		var fchildHeader = byid('wrap-conversations').firstChild;

		//imprimo los encabezados pasandole como referencia lo q tiene q imprimir y a partir de donde (ver función para ver los cambios)
		printHeaders(html[0],fchildHeader);

	}

	if(html[1] == null || flagNM == 0)
	{
		return;
	}
	else
	{	
		printMessages(html[1]);
		flagNM = 0; // No se si hace falta resetearla, lo pongo por las dudas ahora.....

	}
}//end printUpdates


//============================= AUTOCOMPLETE FUNCTIONS

// Esto es lo incluye la prueba del autocompletado:

// inbox.php: autocomplete()
// - lib.js: autoComplete(), function suggest()
// ajax/autoComplete.php
// BOusers->autoComplete(), getComplete() (las puse en esa clase pq en este caso responde a busqueda de users, pero si te parece podemos mudarla)
// UsersTable, autoComplete($ref)
// ajax/searchTool.php

// Avance un poco con el autocompletado...
// toma 3 eventos: 
//keypress:  tomo lo q el tipo escribe un segundo despues de q termina.
//paste: tomo lo q el tipo pegue con mouse o ctrl + v
//keydown: una vez q selecciono de la lisa, con este evento puedo volver a reactivar (ejecutar)la consulta.
// Basicamente te va listando las opciones q se generan de acuerdo a lo q vas ingresando. Luego seleccionas y listo.

// PENDIENTE:

// - poder navegar la lista q se despliega con las flechas (intento en lineas 528 a 532)
// - Ver q parametros queremos tomar, mostrar y enviar (facil pq ya funciona, es elegir). La idea seria q te muestre fotito y nombre...
// - Es muy lento. Desde q ingresas un caracter hasta q desplliega tarda mucho. Intente cachear el array y pude, pero no se bien como manejar el tema cacheo, vos?
// - Ver si se buguea en determinadas situaciones y como convive con las otras consultas. De todas formas esta en proceso y van a aparecer algunas cosas supongo
// - Los elementos q cree son al tun tun cortando y pegando del css, una vez sepamos com va a caminar, lo hacemos bien.

// En fin, si podes hechale un vistazo a ver si se te ocurre como optimizarlo. No se si es lo mejor, pero estuve todo el dia y es lo q hay jajaj
// Asi q una mirada agena aporta!


LetterCounter = 0; // Global variable
function searchField(){

	byid('inputTo').addEventListener("keypress", handler, false); 
	byid('inputTo').addEventListener("paste", handler, false); 
	byid('inputTo').addEventListener("keydown", handler, false);

}//end autoComplete

function handler(){

	 	/* var e = e || window.event;
	 	  if (e.keyCode == '38' || e.keyCode == '40') {
	 	  	alert('hola');
	     }*/

		if(byid('suggestions')){

			byid('suggestions').parentNode.removeChild(byid('suggestions'));
		}
		
		LetterCounter++;
		setTimeout("lookFor("+ LetterCounter +")", 1000);

}//end handler

function lookFor(compareCounter){
	
	if(compareCounter == LetterCounter) {
		
		var vars = 'user=' + byid('inputTo').value;
			ajax('POST', 'ajax/autoComplete.php', suggest , vars, true);
	}
}//end lookFor

function suggest(){

	var html = eval(this.responseText);
	var uls = create('ul');
		uls.id = 'suggestions';
		byid('searchField').appendChild(uls);

		for(var i = 0; i < html.length; i++){

			var each = html[i]['NICKNAME'];
			
			if(byid(each) === null){

				var lis = create('li');
				lis.id = each;
				lis.role="option";
				lis.innerHTML = each;
				byid('suggestions').appendChild(lis);

				byid(each).onclick = function(){

					byid('inputTo').value = this.id;
					byid('suggestions').parentNode.removeChild(byid('suggestions'));
				}
			}
		}//end for
}//end autoComplete




//=============================================================================== BIN



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
