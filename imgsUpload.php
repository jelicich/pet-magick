<!doctype html>

<!--[if lte IE 8]>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<![endif]-->

<html>
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<style>

#imgContainer{
	
	width: 200px;
	height: 200px;
	border: 2px solid gray;
}

</style>


</head>
<body>

	
	<div id='imgContainer'></div>

	<iframe name="iframe_IE" src="" style="display: none"></iframe> 

	<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
		 
		 <!-- <input id="file-id" type="file" name="file" /> -->

		  <p id="upload-status"></p>
		  <pre id="result"></pre>

	</form>

<script type="text/javascript">

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
	
	xhr = createXMLHTTPObject();
	xhr.open(metodo, url, async);
	/*if (metodo ==  'POST'){
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	}*/
	xhr.upload.addEventListener('load', onloadHandler, false); 
	//xhr.upload.addEventListener('loadstart', onloadstartHandler, false);
    //xhr.upload.addEventListener('progress', onprogressHandler, false);
	//xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);
	
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

function byid(s){
	
	return document.getElementById(s);
}//end byid

function create(s){

	return document.createElement(s);
}//end create

function vardump(){
	
	console.log(this.responseText);
}//end vardump

function whilst(s){
	while (s.hasChildNodes()){
	  s.removeChild(s.firstChild);
	}
}//end whilst

function onloadHandler(evt){
  
  var div = byid('upload-status');
  	  whilst(byid('imgContainer'));
}// end onloadHandler



// Parametros a pasar:
						// 'profile'
						// 'video'
						// 'album'

function imgVideoUploader(whatFor){
		
		var amount = whatFor;

		// ===========================COMMON VARs & FUNCTIONS
		var file_id = create('input');
		    file_id.type = 'file';
		
		var allCaption = [];
		//var allElementos = []; // PRUEBA PARA ELEMENTOS DE PERFIL
		var caption;
		var filesSelected = []; 
		var filesSelectedPosition = 0;
		var formData;
		var mime = ['image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 
			  		'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav'];
		var mimeImg = [ 'image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'];
		var mimeVideo= [ 'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav'];

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
		BARRA DE PROGRESO  
		-----------------
		La barra de progreso queda pendiente para cuando ande todo mas o menos homogeneamente en todos los navegadores

		var progress = create('div'); 
		var bar = create('div');
		*/  	

		function normalWay(whatFor){

				  file_id.id = 'file_id';
				  file_id.name = 'file';
				  byid('form-id').appendChild(file_id);

				 
		      	  var uploadBtn = create('input');
				  	  uploadBtn.type = 'button';
				  	  uploadBtn.value = 'Upload';

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
		            			
		            		}if( amount != 'video' && mimeImg.indexOf(this.files[0].type) == -1){

		            			errMsg('Pasale el parametro para video desde js');
		            			var noRemoveInput = true;

		            		}if( amount == 'video' && mimeVideo.indexOf(this.files[0].type) == -1){

		            			errMsg('Pasale el parametro para video desde js');
		            			var noRemoveInput = true;
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

					        	    if (amount != 'profile'){

					        	    		var contCap = create('div');
					        	    		contCap.id = 'contCap';
					        	    		byid('form-id').appendChild(contCap);

				        	    			if(amount == 'video'){

									    		title = create('input');
												title.type = 'text';
						                    	title.id = 'title_' + filesSelectedPosition;
										    	title.name = 'title';
										    	byid('contCap').appendChild(title);
									    	}

					        	    		caption = create('input');
											caption.type = 'text';
					                    	caption.id = 'caption_' + filesSelectedPosition;
									    	caption.name = 'caption';
									    	byid('contCap').appendChild(caption);
									}


						        	if(amount != 'video'){
							        	
							        	var selectedImg = create('img');
						          			selectedImg.id = 'img_' + filesSelectedPosition;
						                    selectedImg.setAttribute('src', e.target.result);
						                    selectedImg.setAttribute('alt', e.target.result);
						                    //alert(selectedImg.width + 'x' + selectedImg.height); //funca
						                    selectedImg.style.width = '20%';
						                    selectedImg.style.height = '20%';
						                    selectedImg.style.margin = '5px 5px';
						                    selectedImg.style.float = 'left';

						                    removeErr();
						                    byid('imgContainer').appendChild(selectedImg);


									    selectedImg.onclick = function(){

						                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
						                  	
						                  	if (amount != 'profile'){
							                    
							                    var captionPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
							                        byid('caption_' + captionPosition).parentNode.removeChild(byid('caption_' + captionPosition));
							                    	
							                 }

							                 this.parentNode.removeChild(this);
							                 filesSelected[ImgPosition] = 'Remover esta posicion!!!'; // remover esta posicion del array

							                  if (amount != 'album'){
				  	  		
										  	  		file_id.id = 'file_id';
													file_id.name = 'file';
													byid('form-id').appendChild(file_id);;
										  	  }
					                }
				                  }// if != video
					            }// end onload
					            reader.readAsDataURL(this.files[0]);
				      }// end if

			      	  filesSelectedPosition++;
				  	  filesSelected[filesSelectedPosition] = file_id.files[0];
				  	  file_id.value = '';

				  	  if (filesSelectedPosition >= 1 && amount != 'album' && noRemoveInput != true){
				  	  		
				  	  		file_id.parentNode.removeChild(file_id);
				  	  }
				  }// end onchange

				  uploadBtn.onclick = function (evt) {

				  			formData = new FormData();

				   			var inputsText = document.getElementsByName('caption');
				   			
							
							for(i = 0; i < inputsText.length; i++){ 

								allCaption.push(inputsText[i].value);
							}

							for (var i = 0; i < filesSelected.length; i++) {

					   			formData.append("file[]", filesSelected[i]);
					   			
					   			if(amount == 'album'){
						   			formData.append("caption[]", allCaption[i]);
						   		}

					   			filesSelected[i] = '';
					   		}

					   			if(amount == 'video'){
					   				var inputsTitle = document.getElementsByName('title');
					   				formData.append("caption", inputsText[0].value);
					   				formData.append("title", inputsTitle[0].value);

					   			}
					   	
					   		/*if(filesSelected == ''){ // ============================= EMPTY FILE VALIDATION
					   			
					   			errMsg('Debe seleccionar una img desde js'); 
					   			//console.log(filesSelected);
					   			return;
					   		}*/

					   		ajax('POST', 'ajax/insertar.php', printErr, formData, true);
					   		byid('contCap').parentNode.removeChild(byid('contCap')); // Elimina los captions
					   		

				   		 	if (amount != 'album'){

				   		 		  file_id.id = 'file_id';
								  file_id.name = 'file';
								  byid('form-id').appendChild(file_id);
							} 
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

				
				function in_array(value, anArray){
				   
					    var found = 0;

					    for (var i=0, len=anArray.length;i<len;i++) {

						        if (anArray[i] == value) return i;
						            found++;
					    }
					    return -1;
				}// end in_array
				

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

								     removeErr();
								     // ============================= FORMAT VALIDATION

									var ext = fileFormat(this.value, '.');

									if( amount != 'video' && in_array('image/' + ext, mimeImg) == -1){

				            			errMsg('Pasale el parametro para img desde js');
				            			var noRemoveInput = true;
				            			this.parentNode.removeChild(this);
				            			newInput();


				            		}if( amount == 'video' && in_array('video/' + ext, mimeVideo) == -1){

				            			errMsg('Pasale el parametro para video desde js');
				            			var noRemoveInput = true;
				            			this.parentNode.removeChild(this);
				            			newInput();
				            		}

				            		// ============================= END VALIDACIOM

				            		if(noRemoveInput != true){

										
										var selectedImg = create('div');
										  	selectedImg.id = 'img_' + filesSelectedPosition;
										  	selectedImg.style.width = "60px";
											selectedImg.style.height = "60px";
											byid('imgContainer').appendChild(selectedImg);

										if(amount != 'profile'){

											if(amount == 'video'){

									    		title = create('input');
												title.type = 'text';
						                    	title.id = 'title_' + filesSelectedPosition;
										    	title.name = 'title';
										    	byid('form-id').appendChild(title);
									    	}

											caption = create('input');
											caption.type = 'text';
					                    	caption.id = 'caption_' + filesSelectedPosition;
									    	caption.name = 'caption_' + filesSelectedPosition;
									    	byid('form-id').appendChild(caption);
									    }
								    

							    	
								  	

									selectedImg.onclick = function(){

						                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero

						                    if (amount != 'profile'){

						                    	var captionPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
							                    byid('caption_' + captionPosition).parentNode.removeChild(byid('caption_' + captionPosition));
						                    }

						                    this.parentNode.removeChild(this);

						                    byid('file_id_' + ImgPosition).parentNode.removeChild(byid('file_id_' + ImgPosition));

						                    if (amount != 'album'){

						                    	newInput();
						                    }

						            }// end onclick

								    var newPreview = byid('img_' + filesSelectedPosition);
								    	newPreview.style.FILTER = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)';
									    newPreview.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = this.value;

									    byid('file_id_' + filesSelectedPosition).style.display = 'none';

									    filesSelectedPosition++; 
									    
									    if (amount == 'album' /*&& noRemoveInput != true*/){
				  	  		
									  	  		newInput();
									  	 }
									   }// end if(noRemoveInput != true)
							
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

imgVideoUploader('video');

</script>

</body>
</html>


<!--

TUTORIALES UTILIZADOS
=====================

-	http://new-bamboo.co.uk/blog/2012/01/10/ridiculously-simple-ajax-uploads-with-formdata
-   http://stackoverflow.com/questions/12368910/html-display-image-after-selecting-filename
-   http://stackoverflow.com/questions/5397991/html-4-equivalent-of-html-5s-filereader
-   http://ramui.com/articles/ajax-file-upload-using-iframe.html
-   http://www.akchauhan.com/upload-image-using-hidden-iframe/
-	http://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded


PENDIENTE
=========

- eliminar captions al enviar 
- agregar title a video

- poner valores correctos para las validaciones (los q estan son de prueba)
- Mando array con una posicion vacia a php, puede quedar asi o ver de mandarlo bien
- Mostrar imagenes seleccionadas en Safari 5.algo (buscar paralelo a lo q hice con IE7)
- ver si validar cuando presiono upload sin seleccionar nada. No lo hice pq no se si va a haber boton siquiera
- Imprimir el span q manda php cuando valida en IE7. Pq ahora lo manda al iframe y no se como sacarlo de ahi para mostrarlo donde corresponde
- Modificar la ruta del video thumb pq como deberia ser la BD no lo acepta, no tengo idea pq. Igual anda....

- Barra de progreso y/o gif

A tener en cuenta:
==================

- para q sea cross-browser necesitamos el condicional para IE y los meta del header. Osea q estaria bueno ver como los metemos con js 
asi podemos crear el objeto piola.

- todo el html q esta ahora, una vez andando esto, tenemos q ver tambien de poder generarlo. (no pude hacerlo con el iframe pq IE refresca la pagina si no esta desde antes en el html)

-->