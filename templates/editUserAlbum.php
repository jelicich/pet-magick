					<div class="mod-header">
						<h2>Edit my album</h2>
					</div>
					
					<div class="mod-content album-user-edition">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							<div id="upload-status"></div>
							<label>Select pictures</label>
							<input type="file" name="file" id="file_id"/>
							<div class="table">
								<ul>
									<li>
										<div id='imgContainer' class="clearfix albumContainer"></div>
									</li>
								</ul>
							</div>
							

							<div class="album-grid scrollable">
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
												
												<label>
													<img class="thumb-small" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> /><br/>
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
							<!--<input type="hidden" value=<?php //echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/> -->
						<?php
							echo '<a href="#'.$_GET['u'].'" class="btn" id="save-edit-album">Save</a> <a href="#'.$_GET['u'].'" class="btn" id="cancel-edit-album">Cancel</a>';		
						?>
							
						</form>
					</div>
						

						<script type="text/javascript">
							imgVideoUploader('album', 'albumProfile'); // SUBIR IMG
							$('.scrollable').mCustomScrollbar({
							    advanced:{
							        updateOnContentResize: true
							    },
							    theme:"light-thin"
							});
					

							$('.table').mCustomScrollbar({
							    advanced:{
							        updateOnContentResize: true
							    },
							    theme:"light-thin"
							});

							//imgVideoUploader('profile', 'about'); // SUBIR IMG
						</script>