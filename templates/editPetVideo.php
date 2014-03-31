						

					<div class="mod-header">
						<h2>Edit pet video</h2>
					</div>

					<div class="mod-content">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							<div id="upload-status"></div>
							<div class="table">
								<ul class="clearfix">
									<li class="new-pic-cont" style="width:100%">
										<div class="clearfix">
											<div id='imgContainer' class="clearfix albumContainer"></div>
										</div>		
										<p id="file-container">Select video<input type="file" name="file" id="file_id"/></p>
									</li>
								</ul>
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
							
						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-video">Save</a>
								  <a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-video">Cancel</a>';		
						?>
						</form>
					
					</div>		
							

						<script type="text/javascript">
							imgVideoUploader('video', 'pet-video'); // SUBIR IMG

							//imgVideoUploader('profile', 'about'); // SUBIR IMG
						</script>