<!doctype html>
<html>
<head>

<style>

#progress{
	width: 100px;
	height: 10px;
	background-color: yellow;
	position: relative;
}

</style>


</head>
<body>

	<p id="support-notice">Your browser does not support Ajax uploads :-(<br/>The form will be submitted as normal.</p>
	
	<div id='imgContainer'></div>

	<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id">
		 
		  <p><input id="file-id" type="file" name="file" onchange="showSelected(this);"/>
		  	
		  <p><label>From server: <input name="other-field" type="text" id="other-field-id" /></label></p>

		  <p id="upload-status"></p>
		  <p id="progress"></p>
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
	xhr.upload.addEventListener('loadstart', onloadstartHandler, false);
    xhr.upload.addEventListener('progress', onprogressHandler, false);
	xhr.upload.addEventListener('load', onloadHandler, false);
	xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);

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

	  var notice = byid('support-notice');
		  notice.innerHTML = "Your browser supports HTML uploads. Go try me! :-)";
		 
      var uploadBtn = create('input');
	  	  uploadBtn.type = 'button';
	  	  uploadBtn.value = 'Upload AJAX';
	      uploadBtn.id = 'upload-button-id';

		  byid('file-id').parentNode.appendChild(uploadBtn);
		  onlyFile();
}else{

	 var uploadSubmit = create('input');
	  	 uploadSubmit.type = 'submit';
	  	 uploadSubmit.value = 'Upload as usual';
	     uploadSubmit.id = 'upload-submit-id';

	     byid('file-id').parentNode.appendChild(uploadSubmit);
		 fullForm();
}// end else


// =============== Submition

function fullForm(){
 
	  var form = byid('form-id');

	  form.onsubmit = function() {

		    var formData = new FormData(form);
		    var action = form.getAttribute('action');

			    ajax('POST', action, vardump , formData, true);
			    return false;
	  }
}// end fullForm

function onlyFile() {
 
  var uploadBtn = byid('upload-button-id');
 
	  uploadBtn.onclick = function (evt) {
	    
		    var formData = new FormData();
		    var action = 'ajax/insertar.php';
		    var fileInput = byid('file-id');
		    var file = fileInput.files[0];
		    
			    formData.append('file', file);
			    ajax('POST', action, vardump , formData, true);
	  }
}// end onlyFile


// =============== Handlers

function onloadstartHandler(evt) {
  
  var div = byid('upload-status');
  	  div.innerHTML = 'Upload started!';
}// end onloadstartHandler

function onloadHandler(evt) {
  
  var div = byid('upload-status');
  	  div.innerHTML = 'Upload successful!';
}// end onloadHandler

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
	   		result.innerHTML = '<p>The server saw it as:</p><pre>' + evt.target.responseText + '</pre>';
	  }
}// end onreadystatechangeHandler

function showSelected(input){

        if (input.files && input.files[0]) {
            
            var reader = new FileReader();

            reader.onload = function (e) {
              
          		var selectedImg = create('img');

                    selectedImg.setAttribute('src', e.target.result);
                    selectedImg.setAttribute('alt', e.target.result);
                    selectedImg.style.width = '10%';
                    selectedImg.style.height = '10%'; 
                    byid('imgContainer').appendChild(selectedImg);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
}// end showSelected


</script>



</body>
</html>


<!--

TUTORIALES UTILIZADOS

-	http://new-bamboo.co.uk/blog/2012/01/10/ridiculously-simple-ajax-uploads-with-formdata
-   http://stackoverflow.com/questions/12368910/html-display-image-after-selecting-filename
-   http://stackoverflow.com/questions/5397991/html-4-equivalent-of-html-5s-filereader


PENDIENTE

- Adaptar todo a IE 9 e inferior (iframe hidden?)
- Estilo a todo
- Seleccionar multiples imagenes
- Validar tamano y demas (php)
- Eliminar imagen seleccionada si ya no quiero enviarla
- Ver si queremos caption o q mas ademas de la img queremos levantar


-->