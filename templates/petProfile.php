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
									<strong class="nickname"><?php echo htmlspecialchars($p->getName()); ?></strong>

									<ul>
										<li><span><strong>Breed: </strong><?php echo htmlspecialchars($p->getBreed()); ?></span></li>
										<li><span><strong>Traits: </strong><?php echo htmlspecialchars($p->getTraits()); ?></span></li>
										<?php
											if($p->hasTribute($p->getId()))
											{
												echo "<li><a href='pet-tribute.php?t=".$p->getTributeId()."'>View tribute</a></li>";
											}
										?>
									</ul>
								</div>
							</div>
							
							<div class="blind">
								<div class="scrollable-text" id="aboutText">
									<div class="bg-txt-featured-modules">
										<p>
											<?php echo htmlspecialchars($p->getStory()); ?>
										</p>
									</div>
								</div>
							</div>
							
						</div><!-- END PET ABOUT-->
						

						<!-- =========== -->


						<div id="pet-album">
							<div class="flexslider carousel">
								<ul class="slides">


								<?php

									//if($p->getAlbumId())
									//{
										$album = $p->getAlbum($p->getAlbumId());
										$t = sizeof($album);
										$flag = 6;
										$default = 0;

										for($i=0; $i < $t; $i++)
										{
								?>
										
											<li class="sliderCap">
												<a class='link-img'  href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> >
													<img class="thumb-mid" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> alt="<?php echo htmlspecialchars($album[$i]['CAPTION']); ?>"/>
													<dl class='hidden'>
														<dt><?php if(strlen(htmlspecialchars($album[$i]['CAPTION'])) > 25) echo substr(htmlspecialchars($album[$i]['CAPTION']),0,25).'...'; else echo htmlspecialchars($album[$i]['CAPTION']); ?> </dt>
													<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
													</dl>
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
									//}//END IF
								?>
							</div>

							
						</div>

						

						<div id='pet-video'>

								<!--

										<span class='video-last-caption'>
											<h3>$a[0]['TITLE']; ?></h3>
											<span><?php //echo $a[0]['CAPTION']; ?></span>
										</span>

									-->
							<?php


								
								$a = $v->getVideoByPet($p->getId());
								
								if($a){

									
										echo "<div class='videoCap'>
											<a class='petVideo video ppVideo' href= 'video/".$a[0]['VIDEO']."' >
												<span class='wrapper-play'>
													<span class='play'></span>
													<img src= video/".$a[0]['THUMBNAIL']." class='thumb-big video-thumb'/>
												</span>

												<dl class='hidden hidden-profile'>
													<dt>".htmlspecialchars($a[0]['TITLE'])."</dt>
													<dd>".htmlspecialchars($a[0]['CAPTION'])."</dd>
												</dl>
												
											</a>
											
											</div>";



								}else{
									
										echo "<span class='video ppVideo' >
												<span class='wrapper-play'>
													<span class='play videoDefault'></span>
												</span>	
											</span>";
								}
							?>

						<div id='albumVideoButtons'>
								<?php
										if($p->isOwn())
										{
											echo '<a href="#'.$p->getId().'" class="btn" id="edit-pet-album">Edit album</a>';
										

											if($a){

												echo '<a href="#'.$p->getId().'" class="btn" id="delete-pet-video">Delete video</a>';
											    
											}else{

												echo '<a href="#'.$p->getId().'" class="btn" id="upload-pet-video">Upload Video</a>';

											}
										}
								?>
							</div>
						</div>

					</div>


<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			    	editPetProfile();
					editPetAlbum();
					UploadPetVideo();
					deleteVideo();
			</script>

<?php
	}
?>
		<script type="text/javascript">
			flexslider();
			video();
			show_img_up("#pet-profile");
			start_scroll('scrollable-text', false);
		</script>
					





