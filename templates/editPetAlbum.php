						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-album">Save</a><a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-album">Cancel</a>';		
						?>

						<div id='imgContainer'></div>

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

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
												<label>
													<input class="form-element" type="checkbox" name="delete-pic[]" value=<?php echo '"'.$album[$i]['ID_PIC'].'"'; ?> />
													Delete
												</label>
												
											</li>
											
								<?php
										}//end for
								?>
										</ul>
								<?php
									}//END IF
								?>
							</div>
							<input type="hidden" value=<?php echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/>
							
						</form>
							
							

						<script type="text/javascript">
							imgVideoUploader('album', 'pet-album'); // SUBIR IMG

							//imgVideoUploader('profile', 'about'); // SUBIR IMG
						</script>