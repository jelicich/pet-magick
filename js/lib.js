
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

function fileFormat(value, character) // agregue esta funcion pq la repeti en otro lado, como para achicar codigo
{
	var extention = value;
	var index = value.indexOf(character);
  		index ++;
  		value = value.substr(index);
  		return value;
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
	//console.log(options)
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


//============================= PROFILE



function profile()
{
	var as = document.querySelectorAll('.pet-link');
	for(var i = 0; i< as.length; i++)
	{
		as[i].onclick = function(e)		
		{
			e.preventDefault();
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
	}
}	

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














//========================================================================
IMG UPLOAD

				*/
				


function imgVideoUploader(){

		// ===========================COMMON VARs & FUNCTIONS
		var file_id = create('input');
		    file_id.type = 'file';
		
		//var allCaption = [];
		//var caption;
		var filesSelected = []; 
		var filesSelectedPosition = 0;
		var formData;
		var mime = ['image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 
			  		'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav'];

		function support(){
	 
		  return supportFileAPI() && supportEvents() && supportFormData() && supportfileReader();

		  function supportFileAPI() {
		   
			    var fi = create('INPUT');
			    	fi.type = 'file';
			   
			    return 'files' in fi;
		  }

		  function supportEvents() {
		  		
		  		
			    return !! (createXMLHTTPObject() && ('upload' in createXMLHTTPObject()) && ('onprogress' in createXMLHTTPObject().upload));
		  }

		  function supportFormData(){

		    	return !! window.FormData;
		  }

		  function supportfileReader(){

		    	return !! window.FileReader;
		  }
		}// end support

		function errMsg(msg){
			removeErr();
			var errorMsg = create('span');
			errorMsg.id = 'err';
			errorMsg.innerHTML = msg;
			byid('imgContainer').appendChild(errorMsg);
			file_id.value = '';
			return;
		}//end errMsg

		function printErr(){
   			
   			errMsg(this.responseText);
   		}

		function removeErr(){

        	if(byid('err')){ byid('err').parentNode.removeChild(byid('err')); }
        } // tal vez se pueda hacer mejor esto. Lo hago funtion pq lo utilizo mas de una vez

	    /*
	    Estos metas andan, pero como el <head> se parsea antes q el js, en firefox no camina. Va, tira un mensaje en consola
	    Hay q evaluar si nos sirve generarlos desde aca. Pero todo indica q no jajaj

		var meta_1 = create('meta');
			meta_1.setAttribute('content', "text/html;charset=utf-8");
			meta_1.setAttribute('http-equiv', "Content-Type");
		var meta_2 = create('meta');
			meta_2.setAttribute('content', "utf-8");
			meta_2.setAttribute('http-equiv', "encoding");
			document.getElementsByTagName('head')[0].appendChild(meta_1);
			document.getElementsByTagName('head')[0].appendChild(meta_2);
		*/

		/*
		BARRA DE PROGRESO  
		-----------------
		La barra de progreso queda pendiente para cuando ande todo mas o menos homogeneamente en todos los navegadores

		var progress = create('div'); 
		var bar = create('div');
		*/  	

		function normalWay(){

				  file_id.id = 'file_id';
				  file_id.name = 'file';
				  byid('form-id').appendChild(file_id);

//	ESTEBAN >
				/*
		      	  var uploadBtn = create('input');
				  	  uploadBtn.type = 'button';
				  	  uploadBtn.value = 'Upload';
				*/
				// TOMO AL BOTON SAVE DE LA INTERFAZ
				var uploadBtn = byid('save-edit-user');

			  	  file_id.parentNode.appendChild(uploadBtn);
				  
				  file_id.onchange = function(){ 

			        	/*
						BARRA DE PROGRESO  
			         	 -----------------

			        	progress.id = 'progress';
			        	progress.style.width = '100px';
			        	progress.style.height = '5px';
			        	progress.style.backgroundColor = 'gray';
			        	progress.style.position = 'relative';

			        	bar.style.backgroundColor = 'lightblue';
					    bar.style.height = '5px';
					    bar.style.position = 'absolute';

					    byid('imgContainer').appendChild(progress);
					    progress.appendChild(bar);*/

					  if (this.files && this.files[0]) {

						  	// ============================= FILE TYPE AND SIZE VALIDATION

						  	if(mime.indexOf(this.files[0].type) == -1){ // el default era ! -1, recordar por las dudas!!
			            			
			            		//errMsg('formato invalido desde js');
			            			
		            		}else if(this.files[0].size >= 900000000){ // Ver q numero necesitamos

		            			//errMsg('Exede el peso desde js');
		            			
		            		}
		            		
		            		var reader = new FileReader();

					         /*  BARRA DE PROGRESO  
					         	 ---------------------

					         	reader.onprogress = function(data) {

						            if (data.lengthComputable) {                                            
						                
						                var percent = parseInt(((data.loaded / data.total) * 100), 10 );
											bar.style.width =  percent + '%';

										if(percent == 100){ byid('progress').parentNode.removeChild(byid('progress'));}
										//console.log(percent);
									}
						        }*/

						        reader.onload = function(e) {
						        	//console.log(e.target.result);
						        	var selectedImg = create('img');
					          			selectedImg.id = 'img_' + filesSelectedPosition;
					                    selectedImg.setAttribute('src', e.target.result);
					                    selectedImg.setAttribute('alt', e.target.result);
					                    //alert(selectedImg.width + 'x' + selectedImg.height); //funca
					                    selectedImg.style.width = '20%';
					                    selectedImg.style.height = '20%';
					                    selectedImg.style.margin = '5px 5px';
					                    selectedImg.style.float = 'left';
				                    	//caption = create('input');
										//caption.type = 'text';
				                    	//caption.id = 'caption_' + filesSelectedPosition;
								    	//caption.name = 'caption';

									    removeErr();
					                    //byid('form-id').appendChild(caption);
					                    byid('imgContainer').appendChild(selectedImg);


					                    selectedImg.onclick = function(){

						                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
						                   // var captionPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
						                 //   byid('caption_' + captionPosition).parentNode.removeChild(byid('caption_' + captionPosition));
						                    	this.parentNode.removeChild(this);
						                    	filesSelected[ImgPosition] = 'Remover esta posicion!!!'; // remover esta posicion del array
						                    	//console.log('onclick: ' + ImgPosition);
						                    	
						                }
					            }// end onload
					            reader.readAsDataURL(this.files[0]);
				      }// end if

			      	  filesSelectedPosition++;
			      	  //console.log(filesSelectedPosition);
				  	  filesSelected[filesSelectedPosition] = file_id.files[0];
				  	  
				  	  file_id.value = '';
				 }// end onchange



				  uploadBtn.onclick = function (evt) {

				  			formData = new FormData();
				   			//console.log(filesSelected);
					   		for (var i = 0; i < filesSelected.length; i++) {

					   			//allCaption[i] = byid('caption_' + j).value;

					   			//console.log(byid('caption_' + j).value);
					   			formData.append("file[]", filesSelected[i]);
					   			//formData.append("caption[]", allCaption[i]);
					   			filesSelected[i] = '';
					   			
					   		}
// ESTEBAN >			
							//LE AGREGO LOS ELEMENTOS DEL MODULO A GUARDAR
							/*  		var name = byid('usr-name').value;
								formData.append('name', name);

								var lastname = byid('usr-lastname').value;
								formData.append('lastname', lastname);

								var nickname = byid('usr-nickname').value;
								formData.append('nickname',nickname);

								var country = byid('country').value;
								formData.append('country', country);

								var region = byid('region').value;
								formData.append('region', region);

								var city = byid('city').value;
								formData.append('city', city);

								var about = byid('usr-about').innerHTML;
								formData.append('about',about);




							Esto tenes q hacerlo todo adentro de este onclick, aca deberias capturar todos los valores (tal vez por medio de una clase) y meternlos en un array 
							como yo hice con los captions. Ejemplo:

								MisElementos = []; // este iria declarado afuera
								var TodosLosElementos = byid('form-id').getElementsByTagName('input');
					
								for(i = 0; i < TodosLosElementos.length; i++){ //tal vez meter todo en un solo for, no me salio

									if(TodosLosElementos[i].type == 'text' && TodosLosElementos[i].name == 'caption'){

										TodosLosElementos.push(inputsText[i].value);
									}
								}

								Una vez q tenes todo en los valores en un array los metes en una posicion  del formData. ejemplo:

								for (var i = 0; i < filesSelected.length; i++) {

						   			formData.append("file[]", filesSelected[i]);
						   			formData.append("caption[]", allCaption[i]);
						   			formData.append("ElementosArnviar[]", MisElementos[i]);
						   			filesSelected[i] = '';
						   		}

						   		Ahi ya tenes todo en un array y lo mandas. Despues desde insertar lo mismo de lo q ya esta hecho dentro del for. Ejemplo:

						   		$query['usr-name'] = $_POST['ElementosArnviar']['usr-name'][$i];

						   		Ojo, no lo probe pq no me anda el user-profile y no pude testearlo. Pero yo lo haria de esa forma.
						   		En IE es otro  mambo, tenemos q ver como envie los captions y seguir esa modalidad...





						   		/*if(filesSelected == ''){ // ============================= EMPTY FILE VALIDATION
					   			
					   			errMsg('Debe seleccionar una img desde js'); 
					   			//console.log(filesSelected);
					   			return;
					   		}*/

					   		ajax('POST', 'ajax/insertar.php', printErr, formData, true);
				  }// end onclick
		}// end NormalWay

		function fallBack(){

				// ======================= FallBack functions

				function createSubmit(){

			     	 var submit_IE = create('input');
					  	 submit_IE.type = 'submit';
					  	 submit_IE.value = 'Upload as usual';
					     submit_IE.id = 'upload-submit-id';
					     byid('form-id').appendChild(submit_IE);
			    }// end createSubmit

			    function createInput(id){

				     	var id = create('input');
					    	id.type = 'file';
					    	id.name = 'file_' + filesSelectedPosition;
					    	id.id = 'file_id_' + filesSelectedPosition;
					    	byid('form-id').appendChild(id);
				}// end createInput

				/*
				function in_array(value, anArray){
				   
					    var found = 0;

					    for (var i=0, len=anArray.length;i<len;i++) {

						        if (anArray[i] == value) return i;
						            found++;
					    }
					    return -1;
				}// end in_array
				*/

				function formSubmit(){

						whilst(byid('form-id'));
						whilst(byid('imgContainer'));

						createSubmit();

						if(filesSelectedPosition > 0){ filesSelectedPosition = 0; }
						newInput(); 
						console.log('form refresh');
				}// end formSubmit

				function fileFormat(value, character){
	
					var extention = value;
					var index = value.indexOf(character);
				  		index ++;
				  		value = value.substr(index);
				  		return value;
				}//end fileFormat

				function afterSubmit(){

							var inputsSubmit = byid('form-id').getElementsByTagName('input');
					
							for(i = 0; i < inputsSubmit.length; i++){

								//console.log(inputsSubmit[i].value);

								if(inputsSubmit[i].type == 'file' && inputsSubmit[i].value == ''){

									byid(inputsSubmit[i].id).parentNode.removeChild(byid(inputsSubmit[i].id));
								}
							}

							setTimeout(formSubmit,100);
		        }// end afterSubmit

				// ======================= fallback starts running
				 
				 createSubmit();

			     (function newInput(){

			    	 createInput('file_id_' + filesSelectedPosition);
				     byid('file_id_' + filesSelectedPosition).onchange = function(){ 

				     	var selectedImg = create('div');
						  	selectedImg.id = 'img_' + filesSelectedPosition;
						  	selectedImg.style.width = "60px";
							selectedImg.style.height = "60px";

							// ============================= FORMAT VALIDATION

							/*	var ext = fileFormat(this.value, '.');

								if(in_array('image/' + ext, mime) == -1){

									errMsg('Formato invalido desde js');
									return;
									// borar el src del input en el navegador
				            	}*/
			            		// ============================= END VALIDACIOM
			            	
					            	removeErr();
								  	byid('imgContainer').appendChild(selectedImg);

									selectedImg.onclick = function(){

					                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
					                    	this.parentNode.removeChild(this);
					                    	byid('file_id_' + ImgPosition).parentNode.removeChild(byid('file_id_' + ImgPosition));
					                    	console.log('onclick: ' + ImgPosition);
						            }// end onclick

								    var newPreview = byid('img_' + filesSelectedPosition);
								    	newPreview.style.FILTER = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)';
									    newPreview.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = this.value;

									    byid('file_id_' + filesSelectedPosition).style.display = 'none';
									    console.log(filesSelectedPosition);
									    filesSelectedPosition++;
									    newInput();
							
			            }// end onchange
			    })();

				byid('form-id').attachEvent('onsubmit', afterSubmit);
		}// end fallBack

		if(support()){ 
			normalWay();
		}else{ 
			fallBack(); 
		}// end else
}// end imgVideoUploader		

