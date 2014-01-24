
					<div class="mod-header">
						<h2>My pet story</h2>
					</div>
					<div class="mod-content clearfix">
			<?php 
				
				//if($p->getPetList($_GET['p']))
				//{	
					//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
						echo '<a href="#'.$_GET['u'].'" class="btn btn-edit" id="save-new-pet">Save</a><a href="#'.$_GET['u'].'" class="btn btn-cancel" id="cancel-new-pet">Cancel</a>';		
					
					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
						<div id="pet-about">
								<!-- IMG UPLOADER -->
							<div id='imgContainer'></div>

							<iframe name="iframe_IE" src="" style="display: none"></iframe> 
							
							<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
								
								<p id="upload-status"></p>
							  	<pre id="result"></pre>
								
								<div class="pic-caption pet-info">
									<img src="img/pets/thumb/default.jpg" class="thumb-mid"/>
									
									<select name="animal-category" class="form-element">
										<?php
										$cats = $ac->getCategories();
										for($i = 0; $i<sizeof($cats); $i++)
										{
											echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'">'.$cats[$i]['NAME'].'</option>';
										}
										?>
									</select>

									<label for="pet-name">Name</label>
									<input type="text" class="form-element" name="name" id="pet-name" />
									
									<label for="pet-breed">Breed</label>
									<input type="text" class="form-element" name="breed" id="pet-breed" />

									<label for="pet-traits">Traits</label>
									<input type="text" class="form-element" name="traits" id="pet-traits" />
									
								</div>
								
								<div class="bg-txt corregir">
									<label for="pet-story"><textarea class="form-element" name="story"></textarea>
								</div>

							</form>
				<?php 
					//}//END IF pets
				?>
						</div><!--pet about -->
						<div id="pet-album">
						</div>
						<div id="pet-video">
						</div>
					</div><!--content mod-->

			<script type="text/javascript">
				imgVideoUploader('profile', 'add-pet'); // SUBIR IMG

				//imgVideoUploader('profile', 'about'); // SUBIR IMG
			</script>
