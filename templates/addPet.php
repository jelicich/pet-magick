
					<div class="mod-header">
						<h2>Add pet</h2>
					</div>
					<div class="mod-content clearfix add-pet">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							
							<p id="upload-status"></p>



							<ul class="nav nav-tabs user-about-tabs">
								<li class="active"><a href="#prof-pic" data-toggle="tab">Profile Picture</a></li>
								<li><a href="#per-info" data-toggle="tab">Pet Information</a></li>
								<li><a href="#tab-tribute" data-toggle="tab">Tribute</a></li>
							</ul>


						<div class="tab-content">
							
							<div class="tab-pane active clearfix" id="prof-pic">
								<div class="table">
									<label>Pet Profile Picture</label>
									<div id="file-container">
										<input type="file" name="file" id="file_id"/>
									</div>
									<ul>
										<li  class="new-pic-cont">
											<div id='imgContainer' class="clearfix"></div>
										</li>
									</ul>
								</div>
							</div>


							<div class="tab-pane" id="per-info">
								<div class="table">
									<ul class="clearfix li-info">
										<li class="odd">
											<label for="pet-name">
												Name*
												<span class="hid-def"><span class="left-tr"></span>Mandatory field. 15 characters max.</span>
											</label>
											<input type="text" class="form-element mandatory" name="name" id="pet-name" />
										</li>
										<li class="even">
											<label for="pet-breed">
												Breed
												<span class="hid-def"><span class="left-tr"></span>25 characters max.</span>
											</label>
											<input type="text" class="form-element" name="breed" id="pet-breed" />
										</li>
										<li class="odd">
											<label for="pet-traits">
												Traits
												<span class="hid-def"><span class="left-tr"></span>50 characters max.</span>
											</label>
											<input type="text" class="form-element" name="traits" id="pet-traits" />
										</li>
										<li class="even">
											<label for="animal-category">
												Animal category*
												<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
											</label>
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

										<li class="odd">
											<label for="pet-story">Pet story</label>
											<textarea class="form-element" name="story" id="pet-story"></textarea>
										</li>

									</ul>
								</div>
							</div>





							
							<div class="tab-pane" id="tab-tribute">
									<div id="create-tribute">
										<label for="chk-tribute">
											<input type="checkbox" id="chk-tribute" class="form-element" name="create-tribute"/> 
											Create Tribute
										</label>
										
										<div id="hide-tribute" style="display:none" class="table"> 
								<!--	<div class="table"> -->
											
											<div class="cont-tr-tit">
												<label for="tr-title">
													Tribute title*
													<span class="hid-def"><span class="left-tr"></span>Mandatory field. 90 characters max.</span>
												</label>
												<input type="text" name="tr-title" id="tr-title"/>
											</div>

											<ul class="li-info clearfix since-gone">										
												<li>
													<label for="tr-since">Since</label>
													<input type="text" name="tr-since" id="tr-since" readonly="readonly"/>
												</li>
												<li>
													<label for="tr-thru">Gone</label>
													<input type="text" name="tr-thru" id="tr-thru" readonly="readonly"/>
												</li>
											</ul>

											<div class="cont-tr-tit">
												<label for="tr-msg">
													Message*
													<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
												</label>
												<textarea name="tr-msg" id="tr-msg"></textarea>
											</div>

										</div>								
									</div>
							</div>

								
					</div>
						</form>
				<?php 
					//}//END IF pets
				?>

					<?php 
				
							//if($p->getPetList($_GET['p']))
							//{	
							//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
								echo '<a href="#'.$_GET['u'].'" class="btn" id="save-new-pet">Save</a><a href="#'.$_GET['u'].'" class="btn" id="cancel-new-pet">Cancel</a>';		
							
							//$pet = $p->getPet($pets[0]['ID_PET']);
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
