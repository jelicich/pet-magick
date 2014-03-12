
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
/*
function fileFormat(value, character){ // agregue esta funcion pq la repeti en otro lado, como para achicar codigo

	var extention = value;
	var index = value.indexOf(character);
  		index ++;
  		value = value.substr(index);
  		return value;
}
*/
// ======================================================= IE7 support. 
if (!document.querySelector){
	
	(function(d, s) {
		d=document, s=d.createStyleSheet();
		d.querySelectorAll = function(r, c, i, j, a) {
			a=d.all, c=[], r = r.replace(/\[for\b/gi, '[htmlFor').split(',');
			for (i=r.length; i--;) {
				s.addRule(r[i], 'k:v');
				/* -a.addRule(e,'f:b', 0); */
				for (j=a.length; j--;) a[j].currentStyle.k && c.push(a[j]);
				s.removeRule(0);
			}
			return c;
		}
	})();
}

function preventEventsDefault(){
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
	//return false;
}

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


		source = 'log';
		var url = document.URL;
		var n = url.indexOf("/blog/");

		if(n != -1)
		{
			var vars = 'email='+email+'&password='+pass+'&token='+token+'&url=1';
			ajax('POST', '../ajax/login.php', printUserMenu, vars, true);	
		}			
		else
		{
			var vars = 'email='+email+'&password='+pass+'&token='+token;
			ajax('POST', 'ajax/login.php', printUserMenu, vars, true);	
		}
			
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

		
		

		source = 'reg';
		var url = document.URL;
		var n = url.indexOf("/blog/");

		if(n != -1)
		{
			var vars = 'name='+name+'&lastname='+lastname+'&nickname='+nickname +'&email='+email+'&password='+password+
			'&password2='+password2+'&rank='+rank +'&country='+country+'&region='+region+'&city='+city+'&token='+token+'&url=1';
			ajax('POST', '../ajax/reg.php', printUserMenu, vars, true);	
		}
		else
		{
			var vars = 'name='+name+'&lastname='+lastname+'&nickname='+nickname +'&email='+email+'&password='+password+
			'&password2='+password2+'&rank='+rank +'&country='+country+'&region='+region+'&city='+city+'&token='+token;
			ajax('POST', 'ajax/reg.php', printUserMenu, vars, true);	
		}
		
	}
}//end reg
/*
var flag = 0; // showForms(), -- public --
function logRegOnclick(){

	var logButton = byid("link-login");
	var regButton = byid("link-reg");

	logButton.onclick = function(){

		showForms('link-login', 'log-form', 'reg-form');

	}

	regButton.onclick = function(){

		showForms('link-reg', 'reg-form', 'log-form');
	}
}// reemplace los onclick dentro de la function siguiente por esta function asi lo declaro solo una vez

function showForms(link, show, hide){
    
	//byid(link).onclick = function()
	//{
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
				byid(show).style.display = "none"; // esto es lo q hace q en ie 7 se oculte el form al seleccionar algo en el combo
				flag = 0;
			}
		}
	//}
}//end showLogin
*/
//============================= COMBO FUNCTIONS

function printRegions(){

        var code_evaled = this.responseText;
        var selectRegions = byid('region');
		
		function eval_ie(codetoeval) {

		    if (window.execScript){
		    	
		    	// window.execScript('code_evaled = ' + '(' + codetoeval + ')',''); 
		      	var code_evaled = JSON.parse(codetoeval);

		    }else{

		        code_evaled = eval(codetoeval);
		     }

		    return code_evaled;
		}

		var options = eval_ie(code_evaled);

		if(options.length > 1){
			
			byid('region').style.display = 'block';// Ver pq no puedo hacer esto sobre e wrapper, como en regions....
		}
		else
		{
			byid('region').style.display = 'none';
		}

        whilst(selectRegions);

        for(var i = 0; i < options.length; i++) {

            var newOption = document.createElement('option');
            newOption.value = options[i]['RegionID'];
            newOption.innerHTML = options[i]['Region'];
            selectRegions.appendChild(newOption);
        }

        var loading = byid('loading-location');
	    loading.parentNode.removeChild(loading);
}//end printRegions

function printCities(){

        var code_evaled = this.responseText;
        var selectCity = byid('city');
		
		function eval_ie(codetoeval) {

		    if (window.execScript){
		    	
		    	// window.execScript('code_evaled = ' + '(' + codetoeval + ')',''); 
		      	var code_evaled = JSON.parse(codetoeval);

		    }else{

		        code_evaled = eval(codetoeval);
		     }

		    return code_evaled;
		}

		var options = eval_ie(code_evaled);

		if(options.length > 1){
			
			selectCity.style.display = 'block';// Ver pq no puedo hacer esto sobre e wrapper, como en regions....
		}

        whilst(selectCity);

        for(var i = 0; i < options.length; i++) {

            var newOption = document.createElement('option');
            newOption.value = options[i]['CityId'];
            newOption.innerHTML = options[i]['City'];
            selectCity.appendChild(newOption);
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
		ajax('GET', 'ajax/selectRegions.php?'+vars, printRegions, null, true);
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
		ajax('GET', 'ajax/selectCities.php?'+vars, printCities, null, true);

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
	 		//searchField('inputTo');
	 		//searchField('finder') = function(){return;}
	 }

	 // ===========  Submit messages
	 byid('send-message').onclick = function(){
	 	//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
		if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
		{
			xhr.abort();
		}

		var vars = 'message='+ byid('message').value; // Agrego to para enviar destinatario seleccionado.
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
}//end inselectRegions

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

	  		as.onclick = function()
	  		{
	  			//me fijo en el objeto xhr publico si existe y si esta procesando algo y lo borro.
	  			if(xhr && xhr.readyState > 0 && xhr.readyState < 4)
	  			{
	  				xhr.abort();
	  			}
		    	
		    	//e.preventDefault();
		    	preventEventsDefault();
		  		var index = this.href.indexOf('='); // reemplazar por function fileFormat()
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
		console.log(this.responseText);
		var html = eval(this.responseText);

	}else{
		var html = arguments[0];
	}

	for(var i = 0; i < html.length; i++){

		lines = create('li');
		lines.className = 'u'+html[i]['Users']['ID_USER'];
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
}//end refreshInselectRegions

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


//========================================================================  USER-PROFILE FUNCTIONS

/*
FUNCTIONS PROFILE
FUNCTIONS PROFILE
FUNCTIONS PROFILE
*/

//profile cambia las mascotas x ajax
// esta function es igual a selectedFromList(), la otra es reutilizable. Asi q habria q adaptar esta
function profile(){
	
	var as = document.querySelectorAll('.pet-link');
	for(var i = 0; i< as.length; i++)
	{
		as[i].onclick = function()		
		{
			//e.preventDefault();
			preventEventsDefault();
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);
	  		var cont = byid('pet-profile');
	  		var loading = create('img');
			loading.src = 'img/loading.gif'; 
	  		cont.innerHTML = "";
	  		cont.appendChild(loading);
			ajax('GET', 'ajax/getPetProfile.php?p='+p, printPetProfile, null, true);
		}
	}
	
	function printPetProfile()
	{
		var html = this.responseText;
		var cont = byid('pet-profile');
		cont.innerHTML = html;

		var scr = cont.getElementsByTagName('script');
		if(scr.length > 0)
		{
			for(var i = 0; i < scr.length; i++)
			{
				eval(scr[i].innerHTML);
			}
		}
	}
}//end profile	



//load edit templates bellow

function editUserProfile(){

	if(byid('edit-user-info')){
		var editUser = byid('edit-user-info');
		
		editUser.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = 'u='+p.substr(index);
	  		
	  		byid('modal-edit-container').style.display='block';	
			ajax('POST', 'ajax/getEditUser.php', printEditUser, p, true);
		}

		

		function printEditUser()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end editUserProfile

function addPet(){
	if(byid('add-pet')){
		var btn = byid('add-pet');
		btn.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);

	  		byid('modal-edit-container').style.display='block';	
			ajax('GET', 'ajax/getAddPet.php?u='+p, printEditPet, null, true);
		}	


		function printEditPet()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end addPet

function deletePet(){

	var btns = document.querySelectorAll('.delete-pet');
	//console.log(btns);
	for(var i = 0; i < btns.length; i++)
	{
		btns[i].onclick = function()
		{
			var alertCont = create('div');
			alertCont.id = 'alert-container';
			var alertWin = create('div');
			alertWin.id = 'alert-window';
			var alertTxt = create('p');
			alertTxt.id = 'alert-text';
			alertTxt.innerHTML = 'You are about to delete all the information related to your pet. This action can\'t be undone. Do you want to contine?';
			var btnClose = create('a');
			btnClose.className = 'btn';
			btnClose.innerHTML = 'Cancel';
			var btnDelete = create('a');
			btnDelete.className = 'btn btn-danger';
			btnDelete.innerHTML = 'Delete';
			btnDelete.href = this.href;
			btnDelete.id = 'delete-ok';

			document.body.appendChild(alertCont);
			alertCont.appendChild(alertWin);
			alertWin.appendChild(alertTxt);
			alertWin.appendChild(btnClose);
			alertWin.appendChild(btnDelete);

			btnClose.onclick = function()
			{
				document.body.removeChild(alertCont);
			}

			btnDelete.onclick = function()
			{
				var p = this.href;
				var index = p.indexOf('#');
		  		index ++;
		  		p = 'p='+p.substr(index);
				ajax('POST', 'ajax/deletePet.php', refresh, p, true);
			}
		}
	}
}//end deletePet

function editPetProfile(){ // esto se repite, podemos hacer una sola function con parmetros segun el modulo

	
	if(byid('edit-pet-profile')){
		var editPet = byid('edit-pet-profile');

		editPet.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);

	  		byid('modal-edit-container').style.display='block';	
			ajax('GET', 'ajax/getEditPetAbout.php?p='+p, printEditPet, null, true);
		}	


		function printEditPet()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end editPetProfile

function editPetAlbum(){ // esto se repite, podemos hacer una sola function con parmetros segun el modulo

	if(byid('edit-pet-album')){
		var editPet = byid('edit-pet-album');

		editPet.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);

	  		byid('modal-edit-container').style.display='block';	
			ajax('GET', 'ajax/getEditPetAlbum.php?p='+p, printEditPet, null, true);
		}	


		function printEditPet()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end editPetProfile


function UploadPetVideo(){ // esto se repite, podemos hacer una sola function con parmetros segun el modulo

	if(byid('upload-pet-video')){

		var editPet = byid('upload-pet-video');
		editPet.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);

	  		byid('modal-edit-container').style.display='block';	
			ajax('GET', 'ajax/getUploadPetVideo.php?p='+p, printEditPet, null, true);
		}	


		function printEditPet()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end editPetProfile

function deleteVideo(){

	if(byid('delete-pet-video')){
	
			var btns = byid('delete-pet-video');

			  btns.onclick = function()
			{
				var p = this.href;
				var index = p.indexOf('#');
		  		index ++;
		  		//var t=byid('unlinkPath');
		  		//	t=t.href;
		  		p = 'p='+ p.substr(index);

		  		
		  			//alert(t);
		  		ajax('POST', 'ajax/deleteVideo.php', refresh, p, true);
			}
		}
}

function editUserAlbum(){

	if(byid('edit-user-album')){
		var editUser = byid('edit-user-album');
		
		editUser.onclick = function()
		{
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);
	  		
	  		byid('modal-edit-container').style.display='block';	
			ajax('GET', 'ajax/getEditUserAlbum.php?u='+p, printEditUserAlbum, null, true);
		}

		function printEditUserAlbum()
		{
			printEdit('modal-edit', this.responseText);
		}
	}
}//end editUserProfile


function uploadOrganization()
{

	var editPet = byid('upload-organization');
	
	
	editPet.onclick = function()
	{
		preventEventsDefault();
		var p = this.href;
		var index = p.indexOf('#');
  		index ++;
  		p = p.substr(index);

  		byid('modal-edit-container').style.display='block';	
		ajax('GET', 'ajax/getUploadOrganization.php?u='+p, printEditOrg, null, true);
	}	

}//end editPetProfile

function printEditOrg()
{
	printEdit('modal-edit', this.responseText);
}

function deleteOrganization()
{
	var btn = document.querySelectorAll('.delete-org'); 

	for(var i = 0; i < btn.length; i++)
	{
		btn[i].onclick = function()
		{		
			//preventEventsDefault();
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = 'o='+p.substr(index);
	  		
	  		
			ajax('POST', 'ajax/deleteOrganization.php', printUpdatedOrg, p, true);// Mando por aca el id del user?????

		}// end deleteNews[i].onclick		
	}
}	

function printUpdatedOrg()
{
	printEdit('organization', this.responseText);
}


function uploadProject()
{

	var editPet = byid('upload-project');
	
	
	editPet.onclick = function()
	{
		preventEventsDefault();
		var p = this.href;
		var index = p.indexOf('#');
  		index ++;
  		p = p.substr(index);

  		byid('modal-edit-container').style.display='block';	
		ajax('GET', 'ajax/getUploadProject.php?u='+p, printEditPro, null, true);
	}	

}//end editPetProfile

function printEditPro(){

	printEdit('modal-edit', this.responseText);
}

function deleteProject()
{
	var btn = document.querySelectorAll('.delete-project'); 

	for(var i = 0; i < btn.length; i++)
	{
		btn[i].onclick = function()
		{	
			//preventEventsDefault();
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = 'pr='+p.substr(index);
	  		
			ajax('POST', 'ajax/deleteProject.php', printUpdatedPro, p, true);// Mando por aca el id del user?????

		}// end deleteNews[i].onclick		
	}
}	

function printUpdatedPro()
{
	printEdit('project', this.responseText);
}


function uploadVetTalk()
{

	var editPet = byid('upload-vet-talk');
	
	
	editPet.onclick = function()
	{
		preventEventsDefault();
		var p = this.href;
		var index = p.indexOf('#');
  		index ++;
  		p = p.substr(index);

  		byid('modal-edit-container').style.display='block';	
		ajax('GET', 'ajax/getUploadVetTalk.php?u='+p, printEditVet, null, true);
	}	

}//end editPetProfile

function printEditVet()
{
	printEdit('modal-edit', this.responseText);
}

function deleteVetTalk()
{
	var btn = document.querySelectorAll('.delete-vet-talk'); 

	for(var i = 0; i < btn.length; i++)
	{
		btn[i].onclick = function()
		{		
			//preventEventsDefault();
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = 'o='+p.substr(index);
	  		
	  		
			ajax('POST', 'ajax/deleteVetTalk.php', printUpdatedVet, p, true);// Mando por aca el id del user?????

		}// end deleteNews[i].onclick		
	}
}	

function printUpdatedVet()
{
	printEdit('vet-talk', this.responseText);
}




/*
END FUNCTIONS PROFILE
END FUNCTIONS PROFILE
END FUNCTIONS PROFILE
*/
//============================================================================================







function printEdit(idModule, html){		
	var cont = byid(idModule);
	cont.innerHTML = html;
	var scr = cont.getElementsByTagName('script');
	if(scr.length > 0)
	{
		for(var i = 0; i < scr.length; i++)
		{
			eval(scr[i].innerHTML);
		}
	}
}//end printedit



function news(){

	var fl = 0;
	(function showNews()
	{
		if(byid('post-news')){
		var btnCom = byid('post-news');
		var pop = byid('pop-up-click');
		
		btnCom.onclick = function()
		{
			if(fl == 0)
			{
				pop.style.display = 'block';
				fl = 1;
			}
			else
			{
				pop.style.display = 'none';
				fl = 0;
			}
		}
	}
	})();

	function printNews(){
	
		var cont = byid("news-mod");
		cont.innerHTML = this.responseText;
		var scr = cont.getElementsByTagName('script');
		if(scr.length > 0)
		{
			for(var i = 0; i < scr.length; i++)
			{
				eval(scr[i].innerHTML);
			}
		}
	}//end printNews


	if(byid('news_button')){
		byid('news_button').onclick = function(){

			var newsContent = byid('news_content').value;
			var vars = 'news='+ newsContent;
				ajax('POST', 'ajax/postNews.php', printNews, vars, true);	
		}//end byid('news_button').onclick

		var deleteNews = document.querySelectorAll('.deleteNews'); 
		//var deleteNews = getByClass(deleteNews);

		for(var i = 0; i < deleteNews.length; i++){

			deleteNews[i].onclick = function()
			{		//preventEventsDefault();
					var p = this.href;
					var index = p.indexOf('#');
			  		index ++;
			  		p = 'n='+p.substr(index);
			  		
					ajax('POST', 'ajax/deleteNews.php', printNews, p, true);// Mando por aca el id del user?????

			}// end deleteNews[i].onclick	
		}//end for
	}
}//end postNews



function refresh(){
	
	location.reload(true);
}//end addPet

//======================================================================== TRIBUTES FUNCTIONS

function showTribute(){

	var chkTribute = byid('chk-tribute');
	var div = byid('hide-tribute');
	var ins = div.getElementsByTagName('input');
	var txa = div.getElementsByTagName('textarea');

	if(chkTribute)
	{
		chkTribute.onchange = function()
		{
			if(this.checked)
			{
				div.style.display = 'block';
				for(var i = 0; i < ins.length; i++)
				{
					ins[i].className = 'form-element';
				}
				txa[0].className = 'form-element';
			}
			else
			{
				div.style.display = 'none';
				for(var i = 0; i < ins.length; i++)
				{
					ins[i].removeAttribute('class');
				}
				txa[0].removeAttribute('class');
			}
				
		}
	}	
}//end showTribute

function comments(ajaxFile){

	var fl = 0;
	(function showComment()
	{
		if(byid('leave-comment')){
		var btnCom = byid('leave-comment');
		var pop = byid('pop-up-click');
		
		btnCom.onclick = function()
		{
			if(fl == 0)
			{
				pop.style.display = 'block';
				fl = 1;
			}
			else
			{
				pop.style.display = 'none';
				fl = 0;
			}
		}
	}
	})();

if(byid('send-comment')){
	(function postComment()
	{
		
		var comment = byid('comment-txt');
		var submit = byid('send-comment');
		submit.disabled = 'disabled';
		comment.onchange = block;
		comment.onkeyup = block; 
		function block()
		{
			if(comment.value != '')
				submit.removeAttribute('disabled');
			else
				submit.disabled = 'disabled';
		}
		

		submit.onclick = function()
		{
			var idTr = byid('tr-id');

			var vars = 'comment=' + comment.value + '&tribute=' + idTr.value;
			ajax('POST', 'ajax/'+ajaxFile+'.php', printCommentSent, vars, true);	

		}
	})();
}
	function printCommentSent()
	{
		//console.log(this.responseText);
		var html = eval(this.responseText);

		if(html == undefined)
			return;

		li = create('li');
		li.className = 'clearfix';
		if(ajaxFile == 'postQuestion')
		{
			li.innerHTML = '<ul><li class="vet-q clearfix"><a href="user-profile.php?u=' + html[0]['Users']['ID_USER'] + '"> <img src="'+ html[0]['Users']['Pics']['THUMB'] +'" class="thumb-small side-img" /></a><div class="content-description bg-txt"><h3><a href="user-profile.php?u='+html[0]['Users']['ID_USER']+'">'+ html[0]['Users']['NAME'] + ' ' + html[0]['Users']['LASTNAME'] +'</a></h3><p>'+ html[0]['QUESTION'] +'</p><span>'+ html[0]['DATE'] +'</span></div></li><li class="vet-a clearfix"><p>This question has not been answered yet</p></ul>';
		}
		else
		{
			li.innerHTML = '<a href="user-profile.php?u=' + html[0]['Users']['ID_USER'] + '"> <img src="'+ html[0]['Users']['Pics']['THUMB'] +'" class="thumb-small side-img" /></a><div class="content-description bg-txt"><h3><a href="user-profile.php?u='+html[0]['Users']['ID_USER']+'">'+ html[0]['Users']['NAME'] + ' ' + html[0]['Users']['LASTNAME'] +'</a></h3><p>'+ html[0]['COMMENT'] +'</p><span>'+ html[0]['DATE'] +'</span></div>';
		}
		
		
		byid('comments-wrapper').appendChild(li);
		fl = 0;
		var pop = byid('pop-up-click');
		pop.style.display = 'none';
		var comment = byid('comment-txt');
		comment.value = '';
		var submit = byid('send-comment');
		submit.disabled = 'disabled';

	}
}//end tributeComments

//======================================================================== COMMON FUNCTIONS

function selectedFromList(divCont, ajaxFile){ // ver si necesito pasar el div o meto una clase y ya
	
	var as = document.querySelectorAll('.linkToModule'); // '.org-link'
	for(var i = 0; i< as.length; i++)
	{
		as[i].onclick = function()		
		{
			//e.preventDefault();
			preventEventsDefault();
			var p = this.href;
			var index = p.indexOf('#');
	  		index ++;
	  		p = p.substr(index);
	  		var cont = byid(divCont); // 'featured-org'
	  		var loading = create('img');
	  			loading.className = 'loading';
			loading.src = 'img/loading.gif'; 
			whilst(cont);
	  		//cont.innerHTML = ""; // modificar esto
	  		cont.appendChild(loading);
			ajax('GET', ajaxFile + p, printSelectedOrg, null, true); // 'ajax/getSelectedOrg.php?p='
		}
	}
	
	function printSelectedOrg()
	{
		var html = this.responseText;
		var cont = byid(divCont); //'featured-org'
		cont.innerHTML = html;

		var scr = cont.getElementsByTagName('script');
		if(scr.length > 0)
		{
			for(var i = 0; i < scr.length; i++)
			{
				eval(scr[i].innerHTML);
			}
		}
	}
}//end selectedFromList




function modalImg(){ // en Jquery_player.php hay una funcion parecida en jquery. Ver si se puede optimizar...

	var modalImgs = document.querySelectorAll('.link-img'); 

	for(var i = 0; i < modalImgs.length; i++){

		modalImgs[i].onclick = function(){
			
			preventEventsDefault();
			var modalBg = create('div');
				modalBg.id = 'modalBg';
				modalBg.className = 'modalWindows';
				modalBg.style.display = 'block';
				document.body.appendChild(modalBg);

			var closeBlock = create('div');
				closeBlock.id = 'closeBlock';
				byid('modalBg').appendChild(closeBlock);

			var closeA = create('a');
				closeA.id = 'closeA';
				closeA.href = '#';
				byid('closeBlock').appendChild(closeA);

			var closeImg = create('img');
				closeImg.src = 'img/close.png';
				closeImg.alt = 'closeImg';
				byid('closeA').appendChild(closeImg);

			var modalImg = create('img');
				modalImg.src = this.href;
				modalImg.alt = this.href;
				byid('closeBlock').appendChild(modalImg);

			closeA.onclick = function(){

				preventEventsDefault();
				modalBg.parentNode.removeChild(modalBg);
			}
		}
	}
}// end modalImg





function listByCategory(ajaxFile){

	var pets = byid('menuByPet').getElementsByTagName('a');
	for(var i = 0; i < pets.length; i++){

			pets[i].onclick = function()
			{		
					var each = byid('menuByPet').getElementsByTagName('div');
					for(var j = 0; j < each.length; j++){
						each[j].style.display = 'none';
					}

					var arrow = this.parentNode.getElementsByTagName('div');
						arrow[0].style.display = "block";

					var p = this.href;
					var index = p.indexOf('#');
			  		index ++;
			  		p = 'c='+p.substr(index);
					ajax('POST', 'ajax/' + ajaxFile, printByCategory, p, true);

			}// end pets[i].onclick
	}// end for

	function printByCategory(){

		var cont = byid("ModulesByPet");
		cont.innerHTML = this.responseText;
		var scr = cont.getElementsByTagName('script');
		if(scr.length > 0)
		{
			for(var i = 0; i < scr.length; i++)
			{
				eval(scr[i].innerHTML);
			}
		}
		
	}// end printByPet

	
}// end userByPet




function showNotification()
{
	var btn = byid('notification');
	btn.onmouseover = function()
	{
		byid('notification-box').style.display = 'block';
	}
	btn.onmouseout = function()
	{
		byid('notification-box').style.display = 'none';
	}
}

function vetTalkAnswer()
{
	var btns = document.querySelectorAll('.submit-answer');
	for(var i = 0; i<btns.length; i++)
	{
		btns[i].onclick = function()
		{
			id = this.previousElementSibling;
			txt = id.previousElementSibling;
			//publica
			tmpLi = this.parentNode.parentNode.parentNode.parentNode;
			var vars= 'id='+id.value+'&a='+txt.value;
			ajax('POST', 'ajax/answerQuestion.php', removeQuestion, vars, true)
		}
	}

	function removeQuestion()
	{
		var html = this.responseText;
		if(html == '' || html == undefined)
		{
			tmpLi.parentNode.removeChild(tmpLi);
			updateNotification();
		}
		else
		{
			var e = document.createElement(p);
			e.innerHTML = html;
			tmpLi.appendChild(e);
		}
	}

	function updateNotification()
	{
		var a = byid('notification');
		var n = parseInt(a.innerHTML) - 1;
		a.innerHTML = n;

		var b = byid('notification-box').getElementsByTagName('strong')[0];
		var n = parseInt(b.innerHTML) - 1;
		b.innerHTML = n;

		if(a.innerHTML == 0)
		{
			a.parentNode.removeChild(a);
			b.parentNode.removeChild(b);	
		}
	}

}





function favorites(){

	function printEditFavorite(){

			printEdit('favorites-mod', this.responseText);
	}

	

	if(byid('addFavorite')){
		var addFavorite = byid('addFavorite');
		 addFavorite.onclick = function(){

			//var u ='u='+ this.name;

			var u = this.href;
			var index = u.indexOf('#');
	  		index ++;
	  		u = 'u='+u.substr(index);

			ajax('POST', 'ajax/addFavorite.php', vardump, u, true);
			
			var added = create('div');
			var added_span = create('span');
			 	added.className = "myFav alert alert-success";
				added_span.innerHTML = "Favorite";
			addFavorite.parentNode.appendChild(added);
			added.appendChild(added_span);
			addFavorite.parentNode.removeChild(addFavorite);
		}
		
	}else if(document.querySelectorAll('.deleteFavorite')){

		function del_again(){

			var btn = document.querySelectorAll('.deleteFavorite'); 

			for(var i = 0; i < btn.length; i++){
				btn[i].onclick = function()
				{	

					var u = this.href;
					var index = u.indexOf('#');
			  		index ++;
			  		u ='u='+ u.substr(index);
					
					ajax('POST', 'ajax/deleteFavorite.php', printEditFavorite, u, true);

				}// end deleteNews[i].onclick		
			}
			setTimeout(del_again,1000);
		};

		del_again();
	}
}


