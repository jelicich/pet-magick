
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

function ajax_pvt(metodo,url, unaFuncion, mensaje, async) {
	var xhr;
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

var fromId;
var flagNM = 0; 

function inbox(){

	 ajax_pvt('GET', 'ajax/getHeaders.php', printHeaders, null, true);

	 // =========== New messages
	 byid('btn-new-message').onclick = function(){

	 		byid('write-new-message').style.display = "block";
	 		searchField('inputTo');
	 		//searchField('finder') = function(){return;}
	 }

	 // ===========  Submit messages
	 byid('send-message').onclick = function(){
	 	//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
		if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
		{
			xhr.abort();
		}

		var vars = 'message='+ byid('message').value + '&recipient='+byid('id-recipient').value; // Agrego to para enviar destinatario seleccionado.
	 	ajax_pvt('POST', 'ajax/sendMessage.php', printMessages, vars, true); // ejecuta printMessages para imprimir el mensaje q mando

	 	//byid('inputTo').value = '';
	 	byid('message').value = '';

	 }

	 // ===========  Submit new messages
	 byid('send-new-message').onclick = function(){
	 	//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
		if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
		{
			xhr.abort();
		}

		var rcpt = byid('id-recipient').value
		var index = rcpt.indexOf('_');
  		index ++;
  		rcpt = rcpt.substr(index);
		var vars = 'message=' + byid('new-message').value + '&recipient='+rcpt; // Agrego to para enviar destinatario seleccionado.
	 	ajax_pvt('POST', 'ajax/sendMessage.php', vardump, vars, true); // ejecuta printMessages para imprimir el mensaje q mando

	 	byid('inputTo').value = '';
	 	byid('new-message').value = '';
	 	byid('id-recipient').value = '';
	 	byid('write-new-message').style.display = "none";
	 	byid('wrap-messages').innerHTML = '';
	 	byid('write-message').style.display = 'none';
	 }

	 // ====== cancel new message
	 byid('cancel-new-message').onclick = function()
	 {
	 	byid('inputTo').value = '';
	 	byid('new-message').value = '';
	 	byid('id-recipient').value = '';
	 	this.parentNode.style.display = 'none';

	 	if(byid('suggestions')){

	 		byid('suggestions').parentNode.removeChild(byid('suggestions'));
	 	}
	  }
}//end inbox

function printHeaders(){
	//si no viene nada por arguments es q esta ejecutada por ajax
	//console.log(this.responseText);
	if(arguments.length == 0)
	{	
		//console.log(this.responseText);
		var html = eval(this.responseText);	
		if(html == undefined)
		{
			refreshInbox();
			return;
		}	
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

		 each =  html[i]['ID_CONVERSATION'];
		 eachName = html[i]['NAME'] + ' ' + html[i]['LASTNAME'] + ' ' + '(' + html[i]['NICKNAME'] + ')';
		 lastMsg =  html[i]['MESSAGE'];
		 //console.log(lastMsg);

		if(byid(each) === null){ //este es medio al pedo :S para que es?

	 		as = create('a');
	 		as.href = "?c="+ each;
	 		lis = create('li');
	  		lis.id = 'conv-'+ each;
	  		
	  		if(html[i]['ID_USER'] != html[i]['SENDER'])//me fijo de quien es el último mensaje para estilearlo
  			{
  				lis.className += 'msg-sent';
  			}
	  		else
	  		{	
	  			if(html[i]['STATUS'] == 0)
	  				lis.className = 'msg-unread';
	  		}
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

	  		as.onclick = function(e)
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
		  		//byid('inputTo').style.display = "none";
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
	//console.log(this.responseText);
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

	if(html == null || html[0] == null) // html == null para q no tire error al ejecutar algunos eventos (refrescar, submit, etc)
	{
		return;

	}else{
		//si hay busco los encabezados impresos y los borro con try catch, porque si es la primera vez q mandan mensaje no lo va a encontrar
		for(var i = 0; i < html[0].length; i++)
		{	
			try
			{
				var id = 'conv-' + html[0][i]['ID_CONVERSATION'];
				//console.log(id);
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


function searchField(inputField){

	var LetterCounter = 0;
	var inputField = byid(inputField); 

		handler = function(){

				var suggestions = byid('suggestions'); 

					/* 
					var e = e || window.event;
				 	 if (e.keyCode == '38' || e.keyCode == '40') {

				 	 	suggestions.style.display = 'none';
				 	 }
				 	 */

				if(suggestions){

					suggestions.parentNode.removeChild(suggestions);
				}
				
				LetterCounter++;
				setTimeout("lookFor("+ LetterCounter +")", 100);
		}//end handler

		lookFor = function(compareCounter){
			
			if(compareCounter == LetterCounter) {
				
				if(inputField.value != ''){

						ajax('POST', 'ajax/searchTool.php', suggest , false, true);
				}
			}
		}//end lookFor

		suggest = function(){
			
			var vars = inputField.value;
			var typing = inputField.value.length;

			var html = eval(this.responseText);
			var uls = create('ul');
				uls.id = 'suggestions';
				inputField.parentNode.appendChild(uls);

			for(var i = 0; i < html.length; i++){

				var each = html[i]['NICKNAME'];
				var idUser = html[i]['ID_USER'];

				if(each.substring(0, typing) == vars){

					if(byid(each) === null){

						var lis = create('li');
							lis.id = 'user_'+ idUser;
							lis.innerHTML = each;
							suggestions.appendChild(lis);
						
						lis.onclick = function(){
							
							var index = this.id.indexOf('-');
						  		index ++;
						  		byid('id-recipient').value = this.id.substr(index);
								inputField.value = this.innerHTML;
								suggestions.parentNode.removeChild(suggestions);
						}


						document.body.onclick = function(){

								if(byid('suggestions') != null){

									suggestions.parentNode.removeChild(suggestions);
									inputField.value = '';
								}
							}
					}
				}
			}
		}//end suggest

		

		inputField.addEventListener("keypress", handler, false); 
		inputField.addEventListener("paste", handler, false);
		inputField.addEventListener("keydown", handler, false); 
}//end searchField

function searchFieldf(inputField){

	var LetterCounterf = 0;
	var inputField = byid(inputField); 

	var indexLi;
	var currentLi;

		handlerf = function(e){
				var suggestionsf = byid('suggestionsf'); 
				
				var e = e || window.event;
			 	/*
			 	if (e.keyCode == '38' || e.keyCode == '40') {

			 	 	suggestions.style.display = 'none';
			 	}*/
			 	var kc = e.keyCode;
			 	var nav = navigator.appName;
			 	if (nav.indexOf("Firefox") > -1)
			 	{
			 		kc = e.charCode;
			 	}

			 	switch(kc)
			 	{
			 		//up
			 		case 38:
			 			e.preventDefault(); //para evitar que el cursor se vaya al principio
			 			var nextLi = currentLi - 1;
			 			navigate(currentLi,nextLi);
			 			break;
			 		//down
			 		case 40:
			 			var nextLi = currentLi + 1;
			 			navigate(currentLi,nextLi);
			 			break;
			 		//enter
			 		case 13:
			 			goTo(currentLi);
			 			break;

			 		default:
			 			if(suggestionsf){

							suggestionsf.parentNode.removeChild(suggestionsf);
						}
						
						LetterCounterf++;
						setTimeout("lookForf("+ LetterCounterf +")", 100);
						break;
			 	}

				
		}//end handler

		lookForf = function(compareCounterf){
			if(compareCounterf == LetterCounterf) {
				
				if(inputField.value != ''){

						ajax('POST', 'ajax/searchTool.php', suggestf , false, true);
				}
			}
		}//end lookFor

		suggestf = function(){

			//reseteo li actual y cantidad de lis
			currentLi = -1;
			//indexLi = htmlf.length;
			
			var varsf = inputField.value;
			var typingf = inputField.value.length;

			var htmlf = eval(this.responseText);
			var ulsf = create('ul');
				ulsf.id = 'suggestionsf';
				inputField.parentNode.appendChild(ulsf);

			for(var i = 0; i < htmlf.length; i++){

				var eachf = htmlf[i]['NICKNAME'];
				var idUserf = htmlf[i]['ID_USER'];

				if(eachf.substring(0, typingf) == varsf){

					if(byid(eachf) === null){

						var lisf = create('li');
							lisf.id = 'userf_'+ idUserf;
							lisf.innerHTML = eachf;
							suggestionsf.appendChild(lisf);
						
						lisf.onclick = function(){
							
							var indexf = this.id.indexOf('-');
						  		indexf ++;
						  		byid('id-recipientf').value = this.id.substr(indexf);
								inputField.value = this.innerHTML;
								suggestionsf.parentNode.removeChild(suggestionsf);
						}


							document.body.onclick = function(){

								if(byid('suggestionsf') != null){

									suggestionsf.parentNode.removeChild(suggestionsf);
									inputField.value = '';
								}
							}
					}
				}
			}
		}//end suggest

		navigate = function(current, next) 
		{
			var lis = byid('suggestionsf').getElementsByTagName('li');
			//si es menor que cero y menor que el largo de los li (el ultimo debería quedar siempre seleccionado al llegar al tope)

			if(next >= lis.length)
			{
				return;
			}
			else if(next == -1)
			{
				lis[current].removeAttribute('style');
				currentLi = next;
			}
			else
			{
				if(current >= 0 && current < lis.length)
				{
					lis[current].removeAttribute('style');
				}
				//
				if(next >= 0 && next < lis.length)
				{
					lis[next].style.background = 'purple';
					currentLi = next;
				}
			}	
		}

		goTo = function(current)
		{
			if(current== -1)
			{
				var val = byid('finder').value
				window.location.href = "search.php?q="+val;
			}
			else
			{
				var lis = byid('suggestionsf').getElementsByTagName('li');
				var user = lis[currentLi].id
				var index = user.indexOf('_');
		  		index ++;
		  		user = user.substr(index);
				window.location.href = "profile.php?u="+user;
			}
		}

		inputField.addEventListener("keypress", handlerf, false); 
		inputField.addEventListener("paste", handlerf, false);
		inputField.addEventListener("keydown", handlerf, false); 
}//end searchField

//byid('finder').onkeydown = keycheck;

//=============================================================================== IMAGES FUNCTIONS















//=============================================================================== BIN
/*


http://new-bamboo.co.uk/blog/2012/01/10/ridiculously-simple-ajax-uploads-with-formdata
http://www.enricflorit.com/como-subir-multiples-archivos-usando-ajax/#sthash.MhDvBJqN.dpbs
http://cafeconweb.net/subir-archivos-al-servidor-con-ajax-sin-plugin/


PRUEBA:

- lib.js
- ajax/insertar.php
- BOPics.php
- PicsTable.php
- crear html pq lo perdi jaja

function upload_img(){

	byid('upload').onclick = function(){ 
		
		var file = byid('file').name;
		var caption = byid('caption').value;
		var vars = 'img='+file+'&caption='+caption;
		
		ajax('POST', 'ajax/insertar.php', vardump, vars, true);
	}
}//end upload_img


















				*/
				
				

