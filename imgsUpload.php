<!doctype html>

<!--[if lte IE 8]>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<![endif]-->
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

	
	<div id='imgContainer'></div>

	<iframe name="iframe_IE" src="" style="display: none;"></iframe> 

	<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
		 
		  <p><input id="file-id" type="file" name="file"/>

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


//===================================================== UPLOAD IMGS FUNCTIONS

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
	  var file_id = byid('file-id');
      var uploadBtn = create('input');
	  	  uploadBtn.type = 'button';
	  	  uploadBtn.value = 'Upload AJAX';
	      uploadBtn.id = 'upload-button-id';

	      file_id.parentNode.appendChild(uploadBtn);
		  
		  file_id.onchange = function(){ 

		  	formData.append("file[]", file_id.files[0]);
		  	showSelected(this); 
		  	file_id.value = '';
		  }
		  ajaxSubmition(formData);
}else{

	 var submit_IE = create('input');
	  	 submit_IE.type = 'submit';
	  	 submit_IE.value = 'Upload as usual';
	     submit_IE.id = 'upload-submit-id';

	     byid('file-id').parentNode.appendChild(submit_IE);
	     byid('file-id').onchange = function(){ 
 			var imgContainer = byid('imgContainer');
 			var img =  create('img');
 				img.src = this.value;
 				imgContainer.appendChild(img);
	     	alert(this.value);
	     	//img.src.split(":///").pop();

	     }
	
	/* var iframe = create('iframe');
	 	 iframe.id = 'iframe_IE';	
	  	 iframe.name = 'iframe_IE';
	  	 iframe.src = '';
	     iframe.style.display = 'none';*/

	    // byid('form-id').onchange = function(){ alert('hola'); }
	   
	     //document.body.appendChild(iframe);
	   

}// end else

// =============== Submition


function ajaxSubmition(formData) {
 
  var uploadBtn = byid('upload-button-id');
 
	  uploadBtn.onclick = function (evt) {

	  		var action = 'ajax/insertar.php';
		    var fileInput = byid('file-id');
		    //var file = fileInput.files[0];
		    //formData.append('file', file);

			ajax('POST', action, vardump , formData, true);
	  }
}// end ajaxSubmition

function fallBAckIE(){
 
	/*  var form = byid('form-id');

	  form.onsubmit = function() {

		    var formData = new FormData(form);
		    var action = form.getAttribute('action');

			    ajax('POST', action, vardump , formData, true);
			    return false;
	  } */
}// end fallBAckIE




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
	   		result.innerHTML = evt.target.responseText;
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
-   http://ramui.com/articles/ajax-file-upload-using-iframe.html
-   http://www.akchauhan.com/upload-image-using-hidden-iframe/


PENDIENTE

- Adaptar todo a IE 9 e inferior (pasar src correctamente)
- Estilo a todo
- Seleccionar multiples imagenes
- Validar tamano y demas (php)
- Eliminar imagen seleccionada si ya no quiero enviarla
- Ver si queremos caption o q mas ademas de la img queremos levantar


-->