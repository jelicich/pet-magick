
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

function ajax(metodo,url, unaFuncion, mensaje, async) {
	
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

//=============================================================================== LOGIN FUNCTIONS

var source; //variable para poder hacer el switch en print user menu 

function printUserMenu(){

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
 		eval(byid('jslogout').innerHTML); 
 	}	 
}//end printUserMenu

var flagL = 0; //Estas vairables (flagL y R) tienen q ser publicas porque se modifican entre showReg y showLogin
function showLogin(){

	byid('link-login').onclick = function()
	{
		//ajax('POST', 'ajax/getLogin.php', printLogin, null, true);
		if(flagL == 0)
		{
			byid('log-form').style.display = "block";
			flagL=1;
		}	
		else
		{
			byid('log-form').style.display = "none";
			flagL = 0;
		}

		//ESCONDO EL OTRO POR LAS DUDAS
		byid('reg-form').style.display = "none";
		flagR=0;

		
		/*
		//PRUEBA PARA Q SE BORRE SI HACE CLICK EN CUAQLERUI LUGAR
		byid('log-form').onmouseover = function ()
		{
			var over = true;
		}
		byid('log-form').onmouseout = function ()
		{
			over = false;	
		}
		
		document.body.onclick = function()
		{
			if(!over)
			{
				byid('log-form').style.display = "none";
				flagL = 0;
			}
		}
		*/
	}


}//end showLogin

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

var flagR = 0; //Estas vairables (flagL y R) tienen q ser publicas porque se modifican entre showReg y showLogin
function showReg(){
		
	

	byid('link-reg').onclick = function(){
		//ajax('POST', 'ajax/getReg.php', printReg, null, true);
		if(flagR == 0)
		{
			byid('reg-form').style.display = "block";
			flagR=1;
		}	
		else
		{
			byid('reg-form').style.display = "none";
			flagR = 0;
		}

		//ESCONDO EL OTRO POR LAS DUDAS
		byid('log-form').style.display = "none";
		flagL = 0;
	}
}//end showReg

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
		var loading = document.createElement('img');
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
		var loading = document.createElement('img');
		loading.src = 'img/loading.gif'; 
		loading.id='loading-location';
		byid('region-wrapper').appendChild(loading);
		ajax('GET', 'ajax/selectCities.php?'+vars, printCities, false, true);

	};
}//end regionsCombo


//=============================================================================== INBOX FUNCTIONS

function inbox(){

	(function getMessages(){
				
		ajax('GET', 'ajax/getMessages.php', printMessages, null, true);

		
		//comento para que no cargue constantemente
		/*
		if(this.readyState == undefined || this.readyState == 4){

			t = setTimeout(getMessages,3000);
		}
		*/
	})();


	 byid('submit').onclick = function(){

	 	var vars = 'from='+byid('from').value+'&to='+byid('to').value+'&subject='+byid('subject').value+'&message='+byid('message').value;
	 	ajax('POST', 'ajax/submit.php', vardump, vars, true); // q funcion metemos aca en lugar de vardump???
	 }

}//end inbox



function printMessages(){
	console.log(this.responseText);
	var html = eval(this.responseText);
	//console.log(html);
  
    for(var i = 0; i < html.length; i++)
	{
 	  var lines = document.createElement('p');
	 	  lines.innerHTML = 'From:' + html[i]['Users']['NAME'] + '<br> subject : '  + html[i]['SUBJECT'] +'<br> message: ' + html[i]['MESSAGE'] + '<br> Fecha: ' + html[i]['DATE'];
		  byid('wrap-messages').appendChild(lines);
	}

function isSent()
{
	
}


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

}//end processResponse






















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
