						<div class="mod-header">
							<h2>My album</h2>
						</div>
						

						

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							<div id='imgContainer'></div>

							<label id="file-container">Profile picture<input type="file" name="file" id="file_id"/></label>

							<div class="slider-small">
								<?php
									if($u->getAlbumId())
									{
										$album = $u->getAlbum($u->getAlbumId());
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
												<label>
													Caption
													<input type="text" class="form-element" name="edit-caption" data-img=<?php echo '"'.$album[$i]['ID_PIC'].'"'; ?> value=<?php echo '"'.$album[$i]['CAPTION'].'"';?> />
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
							<!--<input type="hidden" value=<?php //echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/> -->
						<?php
							echo '<a href="#'.$_GET['u'].'" class="btn" id="save-edit-album">Save</a><a href="#'.$_GET['u'].'" class="btn" id="cancel-edit-album">Cancel</a>';		
						?>
							
						</form>
							
						

						<script type="text/javascript">
							imgVideoUploader('album', 'albumProfile'); // SUBIR IMG

							//imgVideoUploader('profile', 'about'); // SUBIR IMG
						</script>