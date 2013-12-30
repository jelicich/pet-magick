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


 #preview_ie {
    FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)
  }  

</style>


</head>
<body>

	
	<div id='imgContainer'></div>
	<div id="preview_ie"></div>

	<iframe name="iframe_IE" src="" style="display: none;"></iframe> 

	<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
		 
		  <p><input id="file-id" type="file" name="file" />

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
	//xhr.upload.addEventListener('loadstart', onloadstartHandler, false);
    //xhr.upload.addEventListener('progress', onprogressHandler, false);
	xhr.upload.addEventListener('load', onloadHandler, false); !!!
	//xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);

	xhr.open(metodo, url, async);
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

//===================================================== UPLOAD IMGS FUNCTIONS
var file_id = byid('file-id');
var filesSelected = []; // Utilizo este array pq no encontre la forma de resetear formdata (no tengo internet), tal vez pueda optiimzarse....
var filesSelectedPosition = 0;
//var stopUploading = false;


/*
BARRA DE PROGRESO  
-----------------
La barra de progreso queda pendiente para cuando ande todo mas o menos homogeneamente en todos los navegadores
var progress = create('div'); 
var bar = create('div');
*/  


function support(){
 
	  return supportFileAPI() && supportEvents() && supportFormData();

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
}// end support

if(support()){

	  var formData = new FormData();

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

				    //stopUploading = false;
				  if (this.files && this.files[0]) {
	            
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
			                    selectedImg.style.width = '20%';
			                    selectedImg.style.height = '20%';
			                    selectedImg.style.margin = '10px 10px';
			                    selectedImg.style.float = 'left';
			                    byid('imgContainer').appendChild(selectedImg);

			                    selectedImg.onclick = function(){

				                    var ImgPosition = this.id.slice(4); // busccar mejor metodo para obtener el numero
				                    	this.parentNode.removeChild(this);
				                    	filesSelected[ImgPosition] = 'Remover esta posicion!!!'; // remover esta posicion del array
				                    	//console.log('onclick: ' + ImgPosition);
				                    }
			            }

			            reader.readAsDataURL(this.files[0]);
			      }// end if

		      	  filesSelectedPosition++;
		      	  //console.log(filesSelectedPosition);
			  	  filesSelected[filesSelectedPosition] = file_id.files[0];
			  	  file_id.value = '';
   		  }// end onchange

		   uploadBtn.onclick = function (evt) {
		   		
		   			//console.log(filesSelected);
			   		for (var i = 0; i < filesSelected.length; i++) {
			   			
			   			formData.append("file[]", filesSelected[i]);
			   		}

			   		ajax('POST', 'ajax/insertar.php', vardump, formData, true); // cambiar la function vurdump
			   		
			   		//stopUploading = true; // necesito resetear formData. este flag buguea....
			   	}
		   		

		   }

}else{

	fallBackIE();

}// end else

// =============== Submition

function fallBackIE(){
 
	 var submit_IE = create('input');
	  	 submit_IE.type = 'submit';
	  	 submit_IE.value = 'Upload as usual';
	     submit_IE.id = 'upload-submit-id';
	     file_id.parentNode.appendChild(submit_IE);

	     file_id.onchange = function(){ 

	     		showSelectedIE(this);
	     	  //byid('file-id').parentNode.innerHTML =  byid('file-id').parentNode.innerHTML;
	     		
	     }


	    /* var iframe = create('iframe');
	 	 iframe.id = 'iframe_IE';	
	  	 iframe.name = 'iframe_IE';
	  	 iframe.src = '';
	     iframe.style.display = 'none';
	     document.body.appendChild(iframe);*/
}// end fallBackIE

// =============== Handlers


function showSelectedIE(imgFile){

    var newPreview = byid("preview_ie");
	    newPreview.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgFile.value;
	    newPreview.style.width = "160px";
	    newPreview.style.height = "120px";
}// end showSelectedIE    

function onloadHandler(evt){
  
  var div = byid('upload-status');
  	  whilst(byid('imgContainer'));

}// end onloadHandler



</script>

  

       

</body>
</html>


<!--

TUTORIALES UTILIZADOS

-	http://new-bamboo.co.uk/blog/2012/01/10/ridiculously-simple-ajax-uploads-with-formdata
-   http://stackoverflow.com/questions/12368910/html-display-image-after-selecting-filename
-   http://stackoverflow.com/questions/5397991/html-4-equivalent-of-html-5s-filereader
-   http://ramui.com/articles/ajax-file-upload-using-iframe.html
-   http://www.akchauhan.com/upload-image-using-hidden-iframe/
-	http://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded


PENDIENTE

- Eliminar imagen seleccionada si ya no quiero enviarla
- Seleccionar multiples imagenes en IE7, 8 y 9 (ver como enviar el array)
- Mostrar imagenes seleccionadas en Safari 5.algo
- Barra de progreso y/o gif
- Validar tamano y demas (php)
- Ver si queremos caption o q mas ademas de la img queremos levantar


function onloadstartHandler(evt) {
  
  var div = byid('upload-status');
  	  div.innerHTML = 'Upload started!';
}// end onloadstartHandler

function onloadHandler(evt) {
  
  var div = byid('upload-status');
  	  div.innerHTML = 'Upload successful!';
}// end onloadHandler
/*
function onprogressHandler(evt) {
  
  var progress = byid('progress');
  var bar = create('div');
  var percent = evt.loaded/evt.total*100;
 	  progress.appendChild(bar);
 	  //progress.innerHTML =  percent;

	  bar.style.backgroundColor = 'red';
	  bar.style.height = '10px';
	  bar.style.width =  percent + '%';
	  bar.style.position = 'absolute';
}// end onprogressHandler
*/
function onreadystatechangeHandler(evt) {
 
	  var status = null;

	  try {
	   
	    status = evt.target.status;
	  }
	  catch(e) {
	   
	    return;
	  }

	  if (status == '200' && evt.target.responseText) {

	    var result = byid('result');
	   		result.innerHTML = evt.target.responseText;
	  }
}// end onreadystatechangeHandler

-->