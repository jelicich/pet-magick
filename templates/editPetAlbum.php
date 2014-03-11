										
					<div class="mod-header">
						<h2>Edit pet album</h2>
					</div>

					<div class="mod-content">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 

						<div class="table">
							<ul class="clearfix">
								<li class="new-pic-cont" style="width:100%">
									<div class="clearfix">
										<div id='imgContainer' class="clearfix albumContainer"></div>
									</div>		
									<p id="file-container">Select pictures<input type="file" name="file" id="file_id"/></p>
								</li>
							</ul>
						</div>
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

							<div class="album-grid scrolleable">
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
							<input type="hidden" value=<?php echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/>
							
						</form>
						
						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-album">Save</a><a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-album">Cancel</a>';		
						?>
					</div> <!--mod content -->		

						<script type="text/javascript">
							imgVideoUploader('album', 'pet-album'); // SUBIR IMG
							start_scroll('scrolleable');
							//imgVideoUploader('profile', 'about'); // SUBIR IMG
						</script>