
					<div class="mod-header">
						<h2>Add pet</h2>
					</div>
					<div class="mod-content clearfix">


						

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							
							<!--<p id="upload-status"></p>-->
							<div class="table">
								<ul class="clearfix">
									<li class="new-pic-cont" style="width:100%">
										<div class="clearfix">
											<div id='imgContainer' class="clearfix"></div>
										</div>		
										<p id="file-container">Select pet picture<input type="file" name="file" id="file_id"/></p>
									</li>
								</ul>
							</div>
							
							<div class="table">
								<ul class="clearfix">
									<li class="odd">
										<label for="pet-name">Name*</label>
										<input type="text" class="form-element mandatory" name="name" id="pet-name" />
									</li>
									<li class="even">
										<label for="pet-breed">Breed</label>
										<input type="text" class="form-element" name="breed" id="pet-breed" />
									</li>
									<li class="odd">
										<label for="pet-traits">Traits</label>
										<input type="text" class="form-element" name="traits" id="pet-traits" />
									</li>
									<li class="even">
										<label for="animal-category">Animal category*</label>
										<select name="animal-category" class="form-element mandatory" id="animal-category">
											<?php
											$cats = $ac->getCategories();
											for($i = 0; $i<sizeof($cats); $i++)
											{
												echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'">'.$cats[$i]['NAME'].'</option>';
											}
											?>
										</select>
									</li>
								</ul>
							</div>
							<label for="pet-story">Pet story</label>
							<textarea class="form-element" name="story" id="pet-story"></textarea>

							<div id="create-tribute">
								<label for="chk-tribute"><input type="checkbox" id="chk-tribute" class="form-element" name="create-tribute"/> Create Tribute</label>
								
								<div id="hide-tribute" style="display:none" class="table">
									<label for="tr-title">Tribute title*</label>
									<input type="text" name="tr-title" id="tr-title"/>
									<ul class="clearfix">										
										<li class="odd">
											<label for="tr-since">Since</label>
											<input type="text" name="tr-since" id="tr-since" readonly="readonly"/>
										</li>
										<li class="even">
											<label for="tr-thru">Gone</label>
											<input type="text" name="tr-thru" id="tr-thru" readonly="readonly"/>
										</li>
									</ul>
									<label for="tr-msg">Message*</label>
									<textarea name="tr-msg" id="tr-msg"></textarea>
								</div>								
							</div>

							<?php 
				
							//if($p->getPetList($_GET['p']))
							//{	
							//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
								echo '<a href="#'.$_GET['u'].'" class="btn" id="save-new-pet">Save</a><a href="#'.$_GET['u'].'" class="btn" id="cancel-new-pet">Cancel</a>';		
							
							//$pet = $p->getPet($pets[0]['ID_PET']);
							?>		
						</form>
				<?php 
					//}//END IF pets
				?>
						
					</div><!--content mod-->

					

			<script type="text/javascript">
				imgVideoUploader('profile', 'add-pet'); // SUBIR IMG

				showTribute();

				var d = new Date();
				var currentYear = d.getFullYear();
				
			   $("#tr-since").datepicker(
				   	{
				   		dateFormat: "yy-mm-dd",
				   		changeYear: true,
				   		minDate: new Date(1950,1,1),
				   		maxDate: new Date(),
				   		yearRange: "1950:"+currentYear,
				   		changeMonth: true
				   	}
			   	);
			   $("#tr-thru").datepicker(
			   		{
			   			dateFormat: "yy-mm-dd",
			   			changeYear: true,
			   			minDate: new Date(1950,1,1),
			   			maxDate: new Date(),
			   			yearRange: "1950:"+currentYear,
			   			changeMonth: true

			   		}
			   	);
			   $("#tr-since").css("cursor","pointer");
			   $("#tr-thru").css("cursor","pointer");
			   
			
				$('.edit-scrollable').mCustomScrollbar({
				    advanced:{
				        updateOnContentResize: true
				    },
				    theme:"light-thin"
				});
				
			</script>
