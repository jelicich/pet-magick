function imgVideoUploader(whatFor, modulo){

		// ===========================COMMON VARs & FUNCTIONS
		var amount = whatFor;
		/*
		var file_id = create('input');
		    file_id.type = 'file';
		*/
		var file_id = byid('file_id');
		
		var allCaption = [];
		var caption;
		var filesSelected = []; 
		var filesSelectedPosition = 0;
		var formData;
		var mime = ['image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 
			  		'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav'];
		var mimeImg = ['image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'];
		var mimeVideo= [ 'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav'];

		function ajaxx(metodo,url, unaFuncion, mensaje, async) {
	
			xhr = createXMLHTTPObject();
			xhr.open(metodo, url, async);
			xhr.upload.addEventListener('load', onloadHandler, false); 
			
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

		function onloadHandler(evt){
		  
		  var div = byid('upload-status');
		  	  whilst(byid('imgContainer'));
		}// end onloadHandler

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
			//COMENTO ESTA LINEA PARA Q NO IMPRIMA EL ARRAY DE LO QUE SE CARGA
			byid('upload-status').appendChild(errorMsg);
			file_id.value = '';

			return;
		}//end errMsg

		function printErr(){
   			
   			errMsg(this.responseText);
   		} // end printErr

		function removeErr(){

        	if(byid('err')){ byid('err').parentNode.removeChild(byid('err')); }
        } // end removeErr

        function refreshHeader(){

         	 byid('login-reg').innerHTML = this.responseText;
        }// end refreshHeader

		 function refreshPets(){
         	
		  	 byid('pet-list').innerHTML = this.responseText;
		  	 var s = byid('pet-list').getElementsByTagName('script');
		  	 for(var i = 0; i < s.length; i++)
		  	 {
		  	 	eval(s[i].innerHTML);
		  	 }
		 }// end refreshHeader

		
		/* ESTA FUNCION ESTA LISTA< SOLO Q HAY Q VER SI MANDAMOS u,p, y u otro param
		function index(param){

			var p = param;
			var index = p.indexOf('#');
				index ++;
				p = p.substr(index);
			formData.append("u", p);
		}*/

		
	    // ========================================= NORMAL WAY
	
		function normalWay(whatFor){ // Hay q pasar la referencia aca ????

				  /*
				  file_id.id = 'file_id';
				  file_id.name = 'file';
				  */

				  //byid('form-id').appendChild(file_id);
				  //var uploadBtn = byid('save-edit-user');
				    if(modulo == 'about')// tal vez deba poner un nombre para todos y ya
  				    {
			  			var uploadBtn = byid('save-edit-user');
			  			var cancelBtn = byid('cancel-edit-user');
				  	}
				  	else if(modulo == 'pet-about')
				  	{
				  		var uploadBtn = byid('save-edit-pet-about');
				  		var cancelBtn = byid('cancel-edit-pet-about');
			  		}
			  		else if(modulo == 'pet-album')
				  	{
				  		var uploadBtn = byid('save-edit-pet-album');
				  		var cancelBtn = byid('cancel-edit-pet-album');
			  		}
			  		else if(modulo == 'pet-video')/////////////////////////////////////
				  	{
				  		var uploadBtn = byid('save-edit-pet-video');//////////////////////
				  		var cancelBtn = byid('cancel-edit-pet-video');/////////////////////
			  		}/////////////////////////////////////////////////////////////////
			  		else if(modulo == 'albumProfile')
			  		{
						var uploadBtn = byid('save-edit-album');
						var cancelBtn = byid('cancel-edit-album');
			  		}
			  		else if(modulo == 'add-pet')
			  		{
						var uploadBtn = byid('save-new-pet');
						var cancelBtn = byid('cancel-new-pet');
					}
			  	 	else if(modulo == 'organization')
			  		{
						var uploadBtn = byid('save-organization'); 
			  			var cancelBtn = byid('cancel-organization');
			  		}
			  		else if(modulo == 'project')
			  		{
						var uploadBtn = byid('save-project');
			  			var cancelBtn = byid('cancel-project');
			  		}
			  		else if(modulo == 'vet-talk')
			  		{
			  			var uploadBtn = byid('save-vet-talk'); 
			  			var cancelBtn = byid('cancel-vet-talk');	
			  		}
			  	 	else if(modulo == 'blog')
			  		{
						var uploadBtn = byid('save-blog');
			  			var cancelBtn = byid('cancel-blog');
			  		}
			  		else if(modulo == 'admin')/* NUEVO PARA ADMIN ================ */ 
			  		{
						var uploadBtn = byid('save-admin');
			  			var cancelBtn = byid('cancel-admin');
			  		}	
				  
				  //file_id.parentNode.appendChild(uploadBtn);

				/*  function printUpdates(){

						document.location.reload(true);
				  }// end printUpdates
				*/

				function modulPrintUpdates(){

				  		if(modulo == 'about'){

					  			var cont = byid('user-about');
					  			ajaxx('POST', 'ajax/refreshHeader.php', refreshHeader, null, true);

					  	}else if(modulo == 'pet-about'){

					  			var cont = byid("pet-about");
					  			ajaxx('POST', 'ajax/refreshPets.php', refreshPets, null, true);

						}else if(modulo == 'pet-album'){

					  			var cont = byid("pet-album");

				  		}else if(modulo == 'pet-video'){//////////////////////////////

					  			var cont = byid("pet-video");///////////////////////////

				  		}else if(modulo == 'albumProfile'){

				  			var cont = byid('user-album');
				  		
				  		}else if(modulo == 'add-pet'){

				  			var cont = byid('pet-profile');
				  			ajaxx('POST', 'ajax/refreshPets.php', refreshPets, null, true);

				  		}else if(modulo == 'organization'){

				  			var cont = byid('organization');
				  		}
				  		else if(modulo == 'project'){

				  			var cont = byid('project');

				  		}else if(modulo == 'vet-talk'){

				  			var cont = byid('vet-talk');

				  		}else if(modulo == 'blog'){

				  			var cont = byid('blog');
				  		}
				  		else if(modulo == 'admin'){/* NUEVO PARA ADMIN ================ */ 

				  			var cont = byid('admin');
				  		}

				  		cont.innerHTML = this.responseText;
				  		
							var scr = cont.getElementsByTagName('script');
							if(scr.length > 0)
							{
								for(var i = 0; i < scr.length; i++)
								{
									eval(scr[i].innerHTML);
								}
							}
						
						byid('modal-edit-container').style.display = 'none';
						byid('modal-edit').innerHTML = '<img class="loading" src="img/loading.gif" width="25" height="25" />';
				}// end modulPrintUpdates

				// CANCEL SAVE
				cancelBtn.onclick = function(){

					// PRUEBA ESTEBAn
					byid('modal-edit-container').style.display = 'none';
					byid('modal-edit').innerHTML = '<img class="loading" src="img/loading.gif" width="25" height="25" />';
					return;
					//todo lo de abajo sobra borrar
					//FIN PRUEBA

					preventEventsDefault();

					if(modulo == 'about')
					{
			  			var file = 'ajax/getUserAbout.php';
			  			var vars = '?u=';
				  	}
				  	else if(modulo == 'pet-about')
				  	{
				  		var file = 'ajax/getPetAbout.php';
				  		var vars = '?p=';
			  		}
			  		else if(modulo == 'pet-album')
				  	{
				  		var file = 'ajax/getPetAlbum.php';
				  		var vars = '?p=';
			  		}
			  		else if(modulo == 'pet-video')////////////////////////////////
				  	{
				  		var file = 'ajax/getPetVideo.php';////////////////////////
				  		var vars = '?p=';////////////////////////////////////////
			  		}/////////////////////////////////////////////////////////////////
			  		else if(modulo == 'albumProfile')
			  		{
						var file = 'ajax/getUserAlbum.php';
						var vars = '?u=';
			  		}
			  		else if(modulo == 'add-pet')
			  		{
						var file = 'ajax/getPetDefault.php';
						var vars = '?u=';

			  		}
			  		else if(modulo == 'organization')
			  		{
						var file = 'ajax/getOrganizations.php'; 
						var vars = '?u='; // 
			  		}
			  		else if(modulo == 'project')
			  		{
						var file = 'ajax/getProjects.php'; // IMPORTANTE: HACER ESTO> NO HAY CANCEL POR AHORA
						var vars = '?u=';
			  		}
			  		else if(modulo == 'vet-talk')
			  		{
						var file = 'ajax/getVetTalk.php';// IMPORTANTE: HACER ESTO> NO HAY CANCEL POR AHORA
						var vars = '?u=';
			  		}
			  		else if(modulo == 'blog')
			  		{
						var file = 'ajax/getBlogDefault.php';// IMPORTANTE: HACER ESTO> NO HAY CANCEL POR AHORA
						var vars = '?p=';
			  		}
			  		else if(modulo == 'admin') /* NUEVO PARA ADMIN ================ */ 
			  		{
						var file = 'ajax/getAdminDefault.php';// IMPORTANTE: HACER ESTO> NO HAY CANCEL POR AHORA
						var vars = '?p=';
			  		}


		  			var p = this.href;
					var index = p.indexOf('#');
			  		index ++;
			  		p = p.substr(index);
			  		vars += p;
			  		
			  		file+=vars;
			  		//si le paso la variable por argumento no la manda. se la tengo q agregar al archivo al final ?var=bla
			  		ajaxx('POST', file, modulPrintUpdates, null, true);	
			  	} // end cancelSave


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
			            			
			            		errMsg('formato invalido desde js');
			            			
		            		}else if(this.files[0].size >= 900000000){ // Ver q numero necesitamos

		            			errMsg('Exede el peso desde js');
		            			
		            		}if( amount != 'video' && mimeImg.indexOf(this.files[0].type) == -1){

		            			errMsg('Pasale el parametro para video desde js');
		            			var noRemoveInput = true;

		            		}if( amount == 'video' && mimeVideo.indexOf(this.files[0].type) == -1){

		            			errMsg('Pasale el parametro para video desde js');
		            			var noRemoveInput = true;
		            		}
		            		
		            		var reader = new FileReader();

		            		 reader.onload = function(e) {

						        	var contImgCap = create('div');
						        		contImgCap.id = 'cont_' + filesSelectedPosition;
						        		contImgCap.className = 'clearfix';

						        	var selectedImg = create('img');
					          			selectedImg.id = 'img_' + filesSelectedPosition;
					          			selectedImg.className = 'img-upload';

					          			if(amount != 'video'){
						                   
						                    selectedImg.setAttribute('src', e.target.result);
						                    selectedImg.setAttribute('alt', e.target.result);

						                }else{

						                	selectedImg.setAttribute('src', 'video/thumb/default.png');
						                    selectedImg.setAttribute('alt', "");
						                }	
					                    
					                    //alert(selectedImg.width + 'x' + selectedImg.height); //funca
					                    //selectedImg.style.width = '20%';
					                    //selectedImg.style.height = '20%';
					                    //selectedImg.style.margin = '5px 5px';
					                    selectedImg.style.float = 'left';
				                    	
				                    	byid('imgContainer').appendChild(contImgCap); 
				                    	byid('cont_'+filesSelectedPosition).appendChild(selectedImg); 
				                    	  
				                    	  if (amount != 'profile'){

				                    	  		

							        	    	if(amount == 'video'){

							        	    		/*
							        	    		var contCap = create('div');
							        	    		contCap.id = 'contCap';
							        	    		byid('form-id').appendChild(contCap);
							        	    		*/

										    		title = create('input');
													title.type = 'text';
							                    	title.id = 'title_' + filesSelectedPosition;
											    	title.name = 'title';
											    	byid('cont_'+filesSelectedPosition).appendChild(title);
										    	}

										    	if(modulo != 'admin'){/* NUEVO PARA ADMIN ================ */ 

							                    	caption = create('input');
													caption.type = 'text';
							                    	caption.id = 'caption_' + filesSelectedPosition;
											    	caption.name = 'caption';
											    	caption.className = 'form-element';
											    	byid('cont_'+filesSelectedPosition).appendChild(caption);
											    }
										   }

									    removeErr();
					                    
					                   
					                    


					                    selectedImg.onclick = function(){

						                    var ImgPosition = this.id.slice(4); 
						                    byid('cont_' + ImgPosition).parentNode.removeChild(byid('cont_' + ImgPosition));
						                  	
						                  	/*
						                  	if (amount != 'profile'){
							                    if(modulo != 'admin'){
							                    
							                    	var captionPosition = this.id.slice(4);
							                        byid('caption_' + captionPosition).parentNode.removeChild(byid('caption_' + captionPosition));
							                        if(amount == 'video')
							                        	byid('title_' + captionPosition).parentNode.removeChild(byid('title_' + captionPosition));
							                    }
							                 }

							                 this.parentNode.removeChild(this);
							                 filesSelected[ImgPosition] = 'Remover esta posicion!!!'; // remover esta posicion del array
							                 */

							                  if (amount != 'album'){
				  	  						
										  	  		file_id.id = 'file_id';
													file_id.name = 'file';
													byid('file-container').appendChild(file_id);
										  	  }
										  	  if ( modulo == 'admin'){/* NUEVO PARA ADMIN ================ */ 
				  	  							
				  	  								filesSelectedPosition--;
										  	  		file_id.id = 'file_id';
													file_id.name = 'file';
													byid('file-container').appendChild(file_id);
										  	  }
										  	  
						                }
					            }// end onload
					            reader.readAsDataURL(this.files[0]);
				      }// end if

			      	  filesSelectedPosition++;
				  	  filesSelected[filesSelectedPosition] = file_id.files[0];
				  	  file_id.value = '';

				  	  if(filesSelectedPosition >= 2 && modulo == 'admin'  && noRemoveInput  != true){/* NUEVO PARA ADMIN ================ */ 

				  	  	file_id.parentNode.removeChild(file_id);

				  	  }

				  	  if (filesSelectedPosition >= 1 && amount != 'album' && noRemoveInput  != true){
				  	  		
				  	  		file_id.parentNode.removeChild(file_id);
				  	  }
				  }// end onchange

				  uploadBtn.onclick = function (evt) { // este parametro creo q no va...

				  			//VALIDATION
					  		var mandfields = document.querySelectorAll('.mandatory');
					  		var flagidation = 0;
					  		for(var i = 0; i < mandfields.length; i++)
					  		{
					  			// clear fields
					  			mandfields[i].style.boxShadow = 'none';
					  			//
					  			if(mandfields[i].value=='')
					  			{
					  				mandfields[i].style.boxShadow = 'red 0 0 5px';
					  				flagidation = 1;
					  			}
								var n=mandfields[i].className.indexOf("email-field");
					  			if(n != -1)
					  			{
					  				function validateEmail(elementValue)
					  				{        
									   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
									   return emailPattern.test(elementValue);   
									}
									r = validateEmail(mandfields[i].value);
									if(!r)
									{
										mandfields[i].style.boxShadow = 'red 0 0 5px';
										flagidation = 1;
									}
					  			}
					  		}
					  		//TRIBUTE VALIDATION
					  		var chkTribute = byid('chk-tribute');
					  		if(chkTribute)					  			
					  		{
					  			if(chkTribute.checked)
						  		{
						  			var trTitle = byid('tr-title');
						  			var trCont = byid('tr-msg');						  			
						  			if(trTitle.value == '') 
						  			{
						  				trTitle.style.boxShadow = 'red 0 0 5px';
						  				flagidation = 1;
						  			}
						  			if(trCont.value == '')
						  			{
						  				trCont.style.boxShadow = 'red 0 0 5px';
						  				flagidation = 1;
						  			}
						  		}	
					  		}
					  		
					  		if(flagidation == 1) return false;
					  		//END VALIDATION
				  			



				  			formData = new FormData();
				  			//var inputsText = byid('form-id').getElementsByTagName('input');
				   			//LO MODIFICO PARA LEVANTAR TODOS LOS ELEMENTOS DEL FORM POR CLASE, !!!! QUERYSELECTOR funciona en IE 8 en adelante !!! ¿? 
				   			var inputsText = byid('form-id').querySelectorAll('.form-element');

							for(i = 0; i < inputsText.length; i++){ 

								// para eliminar los checkbox q no estan seleccionados, ya que esto levanta todo, seleccionado y no seleccionado
								if(inputsText[i].type == 'checkbox' && inputsText[i].checked == false)
								{
									continue;
								}
								

								if(inputsText[i].type == 'text' && inputsText[i].name == 'caption'){

									allCaption.push(inputsText[i].value);

								}
								/*
								else if(inputsText[i].type == 'text' && inputsText[i].name == 'edit-caption')
								{
									var cap = new Array();
									cap['caption'] = inputsText[i].value;
									var dataImg = inputsText[i].getAttribute('data-img');
									cap['img'] = dataImg;
									formData.append('edit-caption[]', cap);
								}
								*/
								else
								{

									formData.append(inputsText[i].name, inputsText[i].value);
								}

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

					   		/*if(amount == 'video'){
					   				formData.append("caption", inputsText[0].value);
					   			}*/

				   			if(modulo == 'about'){
			  				
					  			var ajaxPostFile = 'ajax/updateUserAbout.php';
						  		var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);

					  		}else if(modulo == 'pet-about'){

					  			var ajaxPostFile = 'ajax/updatePetAbout.php';
						  		var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("p", p);

							}else if(modulo == 'pet-album'){

					  			var ajaxPostFile = 'ajax/updatePetAlbum.php';
						  		var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("p", p);

					  		}else if(modulo == 'pet-video'){////////////////////////////////

					  			var ajaxPostFile = 'ajax/uploadPetVideo.php';////////////////
						  		var p = this.href;///////////////////////////////////////////
								var index = p.indexOf('#');///////////////////////////////////
						  		index ++;///////////////////////////////////////////////////
						  		p = p.substr(index);///////////////////////////////////////
								formData.append("p", p);////////////////////////////////////////

					  		}else if(modulo == 'albumProfile'){

					  			var ajaxPostFile = 'ajax/updateUserAlbum.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);
					  		
					  		}else if(modulo == 'add-pet'){

					  			var ajaxPostFile = 'ajax/uploadPet.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);
					  		}
					  		else if(modulo == 'organization'){

					  			var ajaxPostFile = 'ajax/uploadOrganization.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);

					  		}else if(modulo == 'project'){

					  			var ajaxPostFile = 'ajax/uploadProject.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);

					  		}else if(modulo == 'vet-talk'){

					  			var ajaxPostFile = 'ajax/uploadVetTalk.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);

					  		}else if(modulo == 'blog'){

					  			var ajaxPostFile = 'ajax/uploadBlog.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);

					  		}else if(modulo == 'admin'){

					  			var ajaxPostFile = 'ajax/uploadAdmin.php';
					  			var p = this.href;
								var index = p.indexOf('#');
						  		index ++;
						  		p = p.substr(index);
								formData.append("u", p);
					  		}

					  		

					  		ajaxx('POST', ajaxPostFile, modulPrintUpdates, formData, true);
					  		
					  		var gifload = create('img');
					  		gifload.src = 'img/loading.gif';
					  		gifload.className = 'loading';
					  		gifload.width = '25';
					  		gifload.height = '25';
					  		byid('modal-edit').appendChild(gifload);

						  	if (amount != 'profile'){ 
						  		if( modulo != 'admin'){/* NUEVO PARA ADMIN */
						  			byid('contCap').parentNode.removeChild(byid('contCap')); // Elimina los captions
						  		}
						  	}
					  		if (amount == 'profile' || amount == 'video'){

				   		 		  file_id.id = 'file_id';
								  file_id.name = 'file';
								  byid('file-container').appendChild(file_id);
							} 
				  }// end onclick
			}// end NormalWay


		// ========================================= FALLBACK		
		
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
									    	caption.className = 'form-element';
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