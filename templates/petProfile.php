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
							<div class="pic-caption ">
								<a class='link-img' href=<?php echo '"'.$p->getPic().'"'; ?> >
									<img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/>
								</a>

								<div class="pet-details">
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
							</div>
							
							<div class=" bg-pet-profile ">
								<p><?php echo $p->getStory();?></p>
							</div>
							
						</div><!-- END PET ABOUT-->
						

						<!-- =========== -->


						<div id="pet-album">
							<div class="flexslider carousel">
								<ul class="slides">


								<?php

									if($p->getAlbumId())
									{
										$album = $p->getAlbum($p->getAlbumId());
										$t = sizeof($album);
										$flag = 6;
										$default = 0;

										for($i=0; $i < $t; $i++)
										{
								?>
										
											<li>
												<a class='link-img'  href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> >
													<img class="thumb-mid" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> />
												</a>
												<!-- <p class="img-caption"><?php //echo $album[$i]['CAPTION']; ?></p> -->
											</li>
											
								<?php
										}//end for

										if($t < $flag){
										
											$default = $flag - $t;

											for ($i=0; $i < $default; $i++) { 

												echo "<li>
														<a class='link-img' href= 'img/users/default.jpg' > 
															<img class='thumb-mid' src= 'img/users/thumb/default.jpg' />
														</a> 
													</li>";
											}
										}
								?>
								 	</ul>
								<?php
									}//END IF
								?>
							</div>

							<?php
									if($p->isOwn())
									{
										echo '<a href="#'.$p->getId().'" class="btn" id="edit-pet-album">Edit album</a>';
									}
							?>
						</div>


						<div id='pet-video'>
							<?php
								
								 
								$a = $v->getVideoByPet($p->getId());


								if($a)
								{

									if($p->isOwn())
									{
										echo '<a href="#'.$p->getId().'" class="btn" id="delete-pet-video">Delete video</a>';
									}
							?>
									
									
									<a class="petVideo video" href= <?php  echo 'video/'.$a[0]['VIDEO']; ?> >
										<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
										<span class='wrapper-play'>
											<span class="play"></span>
											<img src= <?php echo '"video/'.$a[0]['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
										</span>

										<span class="video-last-caption">
											<h3><?php echo $a[0]['TITLE']; ?></h3>
											<span><?php echo $a[0]['CAPTION']; ?></span>
										</span>
									</a>
									
							<?php
								}else{

									if($p->isOwn())
									{
										echo '<a href="#'.$p->getId().'" class="btn" id="upload-pet-video">Upload Video</a>';
									}
								}
							?>
						</div>

					</div>

					

<script type="text/javascript">
	editPetProfile();
	editPetAlbum();
	UploadPetVideo();
	deleteVideo();
	flexslider();
</script>



