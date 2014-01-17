
			
			<?php 
				
				//if($p->getPetList($_GET['p']))
				//{	
					//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
					echo '<a href="#'.$_GET['p'].'" class="btn btn-edit" id="save-edit-user">Save</a><a href="#'.$_GET['p'].'" class="btn btn-cancel" id="cancel-edit-user">Cancel</a>';		
					$p->getPetData($_GET['p']);
					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
					
						
						<div class="pic-caption pet-info">
							<a href=<?php echo '"'.$p->getPic().'"'; ?> ><img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/></a>
							<a href="#">Delete</a>

							<label for="pet-name">Name</label>
							<input type="text" class="form-element" name="name" id="pet-name" value=<?php echo '"'.$p->getName().'"' ?> />
							
							<label for="pet-breed">Breed</label>
							<input type="text" class="form-element" name="breed" id="pet-breed" value=<?php echo '"'.$p->getBreed().'"'?>/>

							<label for="pet-traits">Traits</label>
							<input type="text" class="form-element" name="traits" id="pet-traits" value=<?php echo '"'.$p->getTraits().'"'?>/>
							
						</div>
						
						<div class="bg-txt corregir">
							<label for="pet-story"><textarea class="form-element" name="story"><?php echo $p->getStory();?></textarea>
						</div>
						
						

						<!-- VIDEO!!!
						<div class='video'>
							<?php
								$v = $p->getVideo();
								if($v)
								{
							?>
									<div class='wrapper-play'>
										<div class="play"></div>
										<img src=<?php echo '"'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
									</div>

									<div class="video-last-caption">
										<h3><?php echo $v['TITLE'] ?><span>2:12</span></h3>
										
									</div>
							<?php
								} //end if videos
							?>
						</div>
						-->
					
			<?php 
				//}//END IF pets
			?>

			<script type="text/javascript">
				

				//imgVideoUploader('profile', 'about'); // SUBIR IMG
			</script>
