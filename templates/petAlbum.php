							<?php
								$p = new BOPets;
								
								if(isset($_GET['p']))
									$userId = $_GET['p'];
								elseif(isset($_POST['p']))
									$userId = $_POST['p'];
								
								$p->getPetData($userId);
							?>

							
							<?php
									if($p->isOwn())
									{
										//echo '<a href="#'.$p->getId().'" class="btn" id="edit-pet-album">Edit album</a>';
									}
							?>
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
													<img class="thumb-mid" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> />
													<dl class='hidden'>
														<dt><?php echo  htmlspecialchars($album[$i]['CAPTION']); ?> </dt>
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

							
							<script type="text/javascript">
								editPetAlbum();
								//modalImg();
								show_img("#pet-album");
								flexslider();

							</script>