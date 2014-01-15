
			
			<?php 
				
				//if($p->getPetList($_GET['p']))
				//{	
					echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';	
					$p->getPetData($_GET['p']);
					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
					<div class="mod-header">
						<h2>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
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
						
						<div class="slider-small">
							<?php
								if($p->getAlbumId())
								{
									$album = $p->getAlbum($p->getAlbumId());
							?>
									<ul class="clearfix">
							<?php

									for($i=0;$i<sizeof($album);$i++)
									{
							?>
									
										<li>
											<a href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> ><img class="thumb-small" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> /></a>
											<a href=<?php echo '"'.$album[$i]['ID_PIC'].'"'; ?> >Delete</a>
										</li>
										
							<?php
									}//end for
							?>
									</ul>
							<?php
								}//END IF
							?>
						</div>

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
										<!--<span><strong>By: </strong> Petter Putter</span>-->
									</div>
							<?php
								} //end if videos
							?>
						</div>
					</div>
			<?php 
				//}//END IF pets
			?>

			<script type="text/javascript">
				

				//imgVideoUploader('profile', 'about'); // SUBIR IMG
			</script>
