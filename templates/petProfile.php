
			<?php 

					
					//$pet = $p->getPet($pets[0]['ID_PET']);
					
			?>		
					<div class="mod-header">
						<h2>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
						
						<div id="pet-about">
							<?php 
							if($p->isOwn())
							{
								echo '<a href="#'.$p->getId().'" class="btn btn-edit" id="edit-pet-profile">Edit</a>';
							}
							?>
							<div class="pic-caption pet-info">
								<a href=<?php echo '"'.$p->getPic().'"'; ?> ><img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/></a>
								<strong class="nickname"><?php echo $p->getName(); ?></strong>
								<ul>
									<li><span><strong>Breed: </strong><?php echo $p->getBreed();?></span></li>
									<li><span><strong>Traits: </strong><?php echo $p->getTraits();?></span></li>
									<?php
										if($p->hasTribute($p->getId()))
										{
											echo '<li><a href="pet-tribute.php?t='.$p->getTributeId().'" >View tribute</a></li>';
										}
									?>
								</ul>
							</div>
							
							<div class="bg-txt corregir">
								<p><?php echo $p->getStory();?></p>
							</div>
							
						</div><!-- END PET ABOUT-->
						

						<!-- =========== -->


						<div id="pet-album">
							<?php
									if($p->isOwn())
									{
										echo '<a href="#'.$p->getId().'" class="btn" id="edit-pet-album">Edit album</a>';
									}
							?>
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
												<p class="img-caption"><?php echo $album[$i]['CAPTION']; ?></p>
											</li>
											
								<?php
										}//end for
								?>
										</ul>
								<?php
									}//END IF
								?>
							</div>
						</div>


						<div class='video'>
							<?php
								$v = $p->getVideo();
								if($v)
								{

									if($p->isOwn())
									{
										echo '<a href="#'.$pets[0]['ID_PET'].'" class="btn" id="edit-pet-album">Edit Video</a>';
									}
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

					<script type="text/javascript">
						editPetProfile();
						editPetAlbum();
					</script>
	


