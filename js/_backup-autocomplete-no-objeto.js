
function searchField(inputField){

	var LetterCounter = 0;
	var inputField = byid(inputField); 

		handler = function(){

				var suggestions = byid('suggestions'); 

					/* 
					var e = e || window.event;
				 	 if (e.keyCode == '38' || e.keyCode == '40') {

				 	 	suggestions.style.display = 'none';
				 	 }
				 	 */

				if(suggestions){

					suggestions.parentNode.removeChild(suggestions);
				}
				
				LetterCounter++;
				setTimeout("lookFor("+ LetterCounter +")", 100);
		}//end handler

		lookFor = function(compareCounter){
			
			if(compareCounter == LetterCounter) {
				
				if(inputField.value != ''){

						ajax('POST', 'ajax/searchTool.php', suggest , false, true);
				}
			}
		}//end lookFor

		suggest = function(){
			
			var vars = inputField.value;
			var typing = inputField.value.length;

			var html = eval(this.responseText);
			var uls = create('ul');
				uls.id = 'suggestions';
				inputField.parentNode.appendChild(uls);

			for(var i = 0; i < html.length; i++){

				var each = html[i]['NICKNAME'];
				var idUser = html[i]['ID_USER'];

				if(each.substring(0, typing) == vars){

					if(byid(each) === null){

						var lis = create('li');
							lis.id = 'user_'+ idUser;
							lis.innerHTML = each;
							suggestions.appendChild(lis);
						
						lis.onclick = function(){
							
							var index = this.id.indexOf('-');
						  		index ++;
						  		byid('id-recipient').value = this.id.substr(index);
								inputField.value = this.innerHTML;
								suggestions.parentNode.removeChild(suggestions);
						}


						document.body.onclick = function(){

								if(byid('suggestions') != null){

									suggestions.parentNode.removeChild(suggestions);
									inputField.value = '';
								}
							}
					}
				}
			}
		}//end suggest

		

		inputField.addEventListener("keypress", handler, false); 
		inputField.addEventListener("paste", handler, false);
		inputField.addEventListener("keydown", handler, false); 
}//end searchField

function searchFieldf(inputField){

	var LetterCounterf = 0;
	var inputField = byid(inputField); 

	var indexLi;
	var currentLi;

		handlerf = function(e){
				var suggestionsf = byid('suggestionsf'); 
				
				var e = e || window.event;
			 	/*
			 	if (e.keyCode == '38' || e.keyCode == '40') {

			 	 	suggestions.style.display = 'none';
			 	}*/
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
			 			var nextLi = currentLi - 1;
			 			navigate(currentLi,nextLi);
			 			break;
			 		//down
			 		case 40:
			 			var nextLi = currentLi + 1;
			 			navigate(currentLi,nextLi);
			 			break;
			 		//enter
			 		case 13:
			 			goTo(currentLi);
			 			break;

			 		default:
			 			if(suggestionsf){

							suggestionsf.parentNode.removeChild(suggestionsf);
						}
						
						LetterCounterf++;
						setTimeout("lookForf("+ LetterCounterf +")", 100);
						break;
			 	}

				
		}//end handler

		lookForf = function(compareCounterf){
			if(compareCounterf == LetterCounterf) {
				
				if(inputField.value != ''){

						ajax('POST', 'ajax/searchTool.php', suggestf , false, true);
				}
			}
		}//end lookFor

		suggestf = function(){

			//reseteo li actual y cantidad de lis
			currentLi = -1;
			//indexLi = htmlf.length;
			
			var varsf = inputField.value;
			var typingf = inputField.value.length;

			var htmlf = eval(this.responseText);
			var ulsf = create('ul');
				ulsf.id = 'suggestionsf';
				inputField.parentNode.appendChild(ulsf);

			for(var i = 0; i < htmlf.length; i++){

				var eachf = htmlf[i]['NICKNAME'];
				var idUserf = htmlf[i]['ID_USER'];

				if(eachf.substring(0, typingf) == varsf){

					if(byid(eachf) === null){

						var lisf = create('li');
							lisf.id = 'userf_'+ idUserf;
							lisf.innerHTML = eachf;
							suggestionsf.appendChild(lisf);
						
						lisf.onclick = function(){
							
							var indexf = this.id.indexOf('-');
						  		indexf ++;
						  		byid('id-recipientf').value = this.id.substr(indexf);
								inputField.value = this.innerHTML;
								suggestionsf.parentNode.removeChild(suggestionsf);
						}


							document.body.onclick = function(){

								if(byid('suggestionsf') != null){

									suggestionsf.parentNode.removeChild(suggestionsf);
									inputField.value = '';
								}
							}
					}
				}
			}
		}//end suggest

		navigate = function(current, next) 
		{
			var lis = byid('suggestionsf').getElementsByTagName('li');
			//si es menor que cero y menor que el largo de los li (el ultimo debería quedar siempre seleccionado al llegar al tope)

			if(next >= lis.length)
			{
				return;
			}
			else if(next == -1)
			{
				lis[current].removeAttribute('style');
				currentLi = next;
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
					currentLi = next;
				}
			}	
		}

		goTo = function(current)
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

		inputField.addEventListener("keypress", handlerf, false); 
		inputField.addEventListener("paste", handlerf, false);
		inputField.addEventListener("keydown", handlerf, false); 
}//end searchField

//byid('finder').onkeydown = keycheck;





//=============================================================================== IMAGES FUNCTIONS













