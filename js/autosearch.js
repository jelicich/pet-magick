//OBJETO BUSCADOR CON AUTOCOMPLETE
/*

INFO
se instancia:
var bla = autoSearch('id-del-input');

se inicia:
#1:
	bla.ini();	
	//al iniciarlo asi arranca como default como buscador. las opciones son falase por default

#2
	bla.ini({
		'hidden':false;
	}); 
	//idem arriba solo que aca le pasas q es false

#3
	bla.ini({
		'hiden': true;
	});
	//crea un input hidden y la funcionalidad del componente es seleccionar usuarios para mandar mensaje.

*/
function autoSearch(inputId)
{
	var config = 
	{
		initialize:function()
		{
			input.inputField.addEventListener("keypress", handler, false); 
			input.inputField.addEventListener("paste", handler, false);
			input.inputField.addEventListener("keydown", handler, false); 
		}
	}

	var input =
	{
		inputField: document.getElementById(inputId),
		suggestions: document.createElement('ul'),
		LetterCounter: 0,
		currentLi: -1
	}


	function handler(e)
	{
		//var suggestionsf = byid('suggestionsf'); 
		
		var e = e || window.event;
	 	
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
	 			var nextLi = input.currentLi - 1;
	 			navigate(input.currentLi,nextLi);
	 			break;
	 		//down
	 		case 40:
	 			var nextLi = input.currentLi + 1;
	 			navigate(input.currentLi,nextLi);
	 			break;
	 		//enter
	 		case 13:
	 			e.preventDefault(); 
	 			goTo(input.currentLi);
	 			break;
	 		//escape
	 		case 27:
	 			try
				{

					input.suggestions.parentNode.removeChild(input.suggestions);
					//input.inputField.value = '';
				}
				catch(e)
				{
					//wtf
				}
	 			break;
	 		//other keys
	 		case 9:
	 		case 16:
	 		case 17:
	 		case 18:
	 		case 20:
	 		case 33:
	 		case 34:
	 		case 35: 
	 		case 36:
	 		case 45:
	 			e.preventDefault();
	 			break;
	 		default:
	 			var cont = input.inputField.parentNode;
	 			var ul = cont.getElementsByTagName('ul');
	 			if(ul.length > 0)
	 			{
					input.suggestions.parentNode.removeChild(input.suggestions);
				}
				
				
				input.LetterCounter++;
				setTimeout(function()
					{
						lookFor(input.LetterCounter);
					}, 100);
				break;
	 	}

			
	}//end handler

	function navigate(current, next) 
	{
		//var lis = byid('suggestionsf').getElementsByTagName('li');
		var lis = input.suggestions.getElementsByTagName('li');
		//si es menor que cero y menor que el largo de los li (el ultimo debería quedar siempre seleccionado al llegar al tope)

		if(next >= lis.length)
		{
			return;
		}
		else if(next == -1)
		{
			lis[current].removeAttribute('style');
			input.currentLi = next;
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
				input.currentLi = next;
			}
		}	
	}

	function goTo(current)
	{
		if(!config.hidden)
		{
			if(current== -1)
			{
				//var val = byid('finder').value
				var val = input.inputField.value;
				window.location.href = "search.php?q="+val;
			}
			else
			{
				var lis = input.suggestions.getElementsByTagName('li');
				var user = lis[input.currentLi].id
				var index = user.indexOf('_');
		  		index ++;
		  		user = user.substr(index);
				window.location.href = "profile.php?u="+user;
			}	
		}
		else
		{
			var lis = input.suggestions.getElementsByTagName('li');
			var user = lis[input.currentLi].id
			var index = user.indexOf('_');
			index++;
			input.hidden.value = user.substr(index);
			input.inputField.value = lis[input.currentLi].innerHTML;
			while(input.suggestions.hasChildNodes())
			{	
				input.suggestions.removeChild(input.suggestions.lastChild);
			}
			input.suggestions.parentNode.removeChild(input.suggestions);
		}
		
	}

	function lookFor(compareCounter){
			if(compareCounter == input.LetterCounter)
			{
				
				if(input.inputField.value != '')
				{

						ajax('POST', 'ajax/searchTool.php', suggest , false, true);
				}
			}
		}//end lookFor

	function suggest()
	{
		//le borro los hijos, ya que al ser objeto quedan guardados.
		while(input.suggestions.hasChildNodes())
		{	
			input.suggestions.removeChild(input.suggestions.lastChild);
		}
		//reseteo li actual 
		input.currentLi = -1;
		
		var vars = input.inputField.value;
		var typing = input.inputField.value.length;

		var html = eval(this.responseText);
		if(html == undefined) return;
		//var ulsf = create('ul');
		//	ulsf.id = 'suggestionsf';
		input.inputField.parentNode.appendChild(input.suggestions);

		for(var i = 0; i < html.length; i++){

			var each = html[i]['NICKNAME'];
			var idUser = html[i]['ID_USER'];

			if(each.substring(0, typing) == vars){

				if(byid(each) === null){

					var lis = create('li');
						lis.id = 'user_'+ idUser;
						lis.innerHTML = each;
						input.suggestions.appendChild(lis);
					
					lis.onclick = function(){
						
						//var index = this.id.indexOf('-');
					  	//	index ++;
					  		//byid('id-recipientf').value = this.id.substr(index);
							input.inputField.value = this.innerHTML;
							input.suggestions.parentNode.removeChild(input.suggestions);
							var user = this.id;
							var index = user.indexOf('_');
					  		index ++;
					  		user = user.substr(index);	
							if(!config.hidden)
							{
								window.location.href = "user-profile.php?u="+user;
							}
							else
							{
								input.hidden.value = user;
							}
					}


						document.body.onclick = function(){

							try
							{

								input.suggestions.parentNode.removeChild(input.suggestions);
								//input.inputField.value = '';
							}
							catch(e)
							{
								//wtf
							}
						}
				}
			}
		}
	}//end suggest

	//=================================================
	return {
		ini:function()
		{
			//ini recive "obj" por parametro para configurar
			/*
			for(var prop in obj)
		 	{
		 		switch(prop)
		 		{
		 			case 'random':
		 				if(obj[prop] == true)
		 				{
		 					config.random = true;
		 				} 
		 				else
		 				{
		 					config.random = false;
		 				} 
		 				break;
		 			case 'fade':
		 				if(obj[prop] == true)
		 				{
		 					config.fade = true;
		 				} 
		 				else
		 				{
		 					config.fade = false;
		 				} 

		 		}
		 	}
		 	*/
		 	if(arguments.length > 0)
		 	{
		 		var obj = arguments[0];
		 		for(var prop in obj)
			 	{
			 		switch(prop)
			 		{
			 			case 'hidden':
			 				if(obj[prop] == true)
			 				{
			 					config.hidden = true;
			 					input.hidden = document.createElement('input');
			 					input.hidden.type = 'hidden';
			 					input.hidden.name = 'recipient';
			 					input.hidden.id = 'id-recipient';
			 					input.inputField.parentNode.appendChild(input.hidden);
			 				} 
			 				else
			 				{
			 					config.hidden = false;
			 				}
			 				break;
			 
			 			default:
			 				break;

			 		}
			 	}	
		 	}

			config.initialize();
		}
		
	}
	
}
