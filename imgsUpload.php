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

	<iframe name="iframe_IE" src="" style='display:none;'></iframe> 

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
	//xhr.upload.addEventListener('load', onloadHandler, false); 
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







function imgVideoUploader(format){


	if(format == 'img'){ // estos if estan provisoriamente solo en caso de q haga falta diferencialo. Puede q sea al pedo...
		
		// ===========================COMMON VARs & FUNCTIONS
		var file_id = create('input');
		    file_id.type = 'file';

		var filesSelected = []; 
		var filesSelectedPosition = 0;
		var formData;
		var mime = ['image/JPG', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'];

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
			var errorMsg = create('span');
			errorMsg.id = 'err';
			errorMsg.innerHTML = msg;
			byid('imgContainer').appendChild(errorMsg);
			file_id.value = '';
			return;
		}//end errMsg

		 function removeErr(){

	        	if(byid('err')){ byid('err').parentNode.removeChild(byid('err')); }
	     } // tal vez se pueda hacer mejor esto. Lo hago funtion pq lo utilizo mas de una vez

	    /*
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
			            			
			            		//errMsg('formato invalido');
			            			
		            		}else if(this.files[0].size >= 500000){ // Ver q numero necesitamos

		            			//errMsg('Exede el peso');
		            			
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

						        	var selectedImg = create('img');
					          			selectedImg.id = 'img_' + filesSelectedPosition;
					                    selectedImg.setAttribute('src', e.target.result);
					                    selectedImg.setAttribute('alt', e.target.result);
					                    //alert(selectedImg.width + 'x' + selectedImg.height); //funca
					                    selectedImg.style.width = '20%';
					                    selectedImg.style.height = '20%';
					                    selectedImg.style.margin = '10px 10px';
					                    selectedImg.style.float = 'left';
					                    removeErr();
					                    byid('imgContainer').appendChild(selectedImg);

					                    selectedImg.onclick = function(){

						                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
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
					   			
					   			formData.append("file[]", filesSelected[i]);
					   			 filesSelected[i] = '';
					   		}

					   		if(filesSelected == ''){ // ============================= EMPTY FILE VALIDATION
					   			
					   		//	errMsg('Debe seleccionar una img'); 
					   		//	return;
					   		}

					   		ajax('POST', 'ajax/insertar.php', vardump, formData, true); // cambiar la function vurdump
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

				     	var selectedImg = create('div');
						  	selectedImg.id = 'img_' + filesSelectedPosition;
						  	selectedImg.style.width = "60px";
							selectedImg.style.height = "60px";

							// ============================= FORMAT VALIDATION

							var ext = fileFormat(this.value, '.');

							if(in_array('image/' + ext, mime) == -1){
		            			
			            		errMsg('Formato invalido');
			            	}

			            	// ============================= END VALIDACIOM

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

	}else if(format == 'video'){

		alert('video');
	}
}// end imgVideoUploader

imgVideoUploader('img');

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

- Mando array con una posicion vacia a php, puede quedar asi o ver de mandarlo bien
- Mostrar imagenes seleccionadas en Safari 5.algo (buscar paralelo a lo q hice con IE7)

- Barra de progreso y/o gif
- Validar tamano y demas (php)
- Ver si queremos caption o q mas ademas de la img queremos levantar

A tener en cuenta:
==================

- para q sea cross-browser necesitamos el condicional para IE y los meta del header. Osea q estaria bueno ver como los metemos con js 
asi podemos crear el objeto piola.

- todo el html q esta ahora, una vez andando esto, tenemos q ver tambien de poder generarlo. (no pude hacerlo con el iframe pq IE refresca la pagina si no esta desde antes en el html)
  /* 	var img = new Image();
			              	img.src = e.target.result;
							img.onload = function() {
								if(this.width >= 100){alert('culo'); }
							  alert(this.width + 'x' + this.height);
							  return;
							}*/
-->