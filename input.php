<!doctype html>
<html>
<head>
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

function byid(s){

	return document.getElementById(s);
}//end byid

function create(s){

	return document.createElement(s);
}//end create




//=========================================================== COMPONENTE


function searchField(id){

	//==================== autoComplete
	var autoComplete = {

		LetterCounter : 0,
		inputs: create('input'),

		ini:function(){

				this.inputs.id = id;
			var inputsId = byid(id); 

			handler = function(){

				var suggestions = byid(id +'_suggestions');// optimizar esta variable

					if(suggestions){

						suggestions.parentNode.removeChild(suggestions);
					}
					
					autoComplete.LetterCounter++;
					setTimeout("lookFor("+ autoComplete.LetterCounter +")", 100);
			}//end handler

			lookFor = function(compareCounter){
				
				if(compareCounter == autoComplete.LetterCounter) {
					
					if(inputsId.value != ''){

							ajax('POST', 'ajax/searchTool.php', suggest , false, true);
					}
				}
			}//end lookFor

			suggest = function(){
				
				var vars = inputsId.value;
				var typing = inputsId.value.length;

				var html = eval(this.responseText);
				var uls = create('ul');
					uls.id = id +'_suggestions';
					inputsId.parentNode.appendChild(uls);

				var suggestions = byid(id +'_suggestions');// optimizar linea 78

				for(var i = 0; i < html.length; i++){

					var each = html[i]['NICKNAME'];
					var idUser = html[i]['ID_USER'];

					if(each.substring(0, typing) == vars){

						if(byid(each) === null){ 

							var lis = create('li');
								lis.id = id +'_user_'+ idUser;
								//lis.id = 'user_'+ idUser;
								lis.innerHTML = each;
								suggestions.appendChild(lis);
							
							var idRecipient = create('input');
								idRecipient.id = 'idRecipient';
								idRecipient.type = 'hidden';
								idRecipient.name = 'recipent';
								suggestions.appendChild(idRecipient);

							
							lis.onclick = function(){
								
								var index = this.id.indexOf('-');
							  		index ++;
							  		byid('idRecipient').value = this.id.substr(index); // ver si no afecta el envio esta modificacion
									inputsId.value = this.innerHTML;
									suggestions.parentNode.removeChild(suggestions);
							}

							document.body.onclick = function(){

								if(byid(id +'_suggestions') != null){

									suggestions.parentNode.removeChild(suggestions);
									inputsId.value = '';
								}
							}
						}
					}
				}
			}//end suggest

			inputsId.addEventListener("keypress", handler, false); 
			inputsId.addEventListener("paste", handler, false);
			inputsId.addEventListener("keydown", handler, false); 

		}//end ini
	}//end autoComplete
		
	//==================== render

		return {//objeto publico

			renderTo: function(obj){

		        obj.appendChild(autoComplete.inputs);

		        autoComplete.ini();

		    }//end render to
		}//end return
}//end searchField

window.onload = function () {

	 searchField('hola').renderTo(searchField1);
	 searchField('chau').renderTo(searchField2);
}//end window on load


</script>

</head>
<body>

	<div id='searchField1'></div>
	<div id='searchField2'></div>
	

</body>
</html>
