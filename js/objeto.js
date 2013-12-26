//OBJETO BUSCADOR CON AUTOCOMPLETE

function autoSearch(inputId)
{
	config = 
	{
		initialize:function()
		{
			input.inputField.addEventListener("keypress", handler, false); 
			input.inputField.addEventListener("paste", handler, false);
			input.inputField.addEventListener("keydown", handler, false); 
		}
	}

	input =
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
	 			goTo(input.currentLi);
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
		if(current== -1)
		{
			var val = byid('finder').value
			window.location.href = "search.php?q="+val;
		}
		else
		{
			var lis = byid('suggestionsf').getElementsByTagName('li');
			var user = lis[currentLi].id
			var index = user.indexOf('_');
	  		index ++;
	  		user = user.substr(index);
			window.location.href = "profile.php?u="+user;
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

		var htmlf = eval(this.responseText);
		//var ulsf = create('ul');
		//	ulsf.id = 'suggestionsf';
		input.inputField.parentNode.appendChild(input.suggestions);

		for(var i = 0; i < htmlf.length; i++){

			var eachf = htmlf[i]['NICKNAME'];
			var idUserf = htmlf[i]['ID_USER'];

			if(eachf.substring(0, typing) == vars){

				if(byid(eachf) === null){

					var lisf = create('li');
						lisf.id = 'userf_'+ idUserf;
						lisf.innerHTML = eachf;
						input.suggestions.appendChild(lisf);
					
					lisf.onclick = function(){
						
						var indexf = this.id.indexOf('-');
					  		indexf ++;
					  		byid('id-recipientf').value = this.id.substr(indexf);
							input.inputField.value = this.innerHTML;
							input.suggestions.parentNode.removeChild(input.suggestions);
					}


						document.body.onclick = function(){

							if(input.suggestions != null){

								input.suggestions.parentNode.removeChild(input.suggestions);
								input.inputField.value = '';
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
			config.initialize();
		}
		
	}
	
}
