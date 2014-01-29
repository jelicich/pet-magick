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
							
							<script type="text/javascript">
								editPetAlbum();
							</script>