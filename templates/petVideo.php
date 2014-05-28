						
					<div class="mod-header">
						<h2>Edit pet video</h2>
					</div>

					<div class="mod-content video-modal">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 


						
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							<div id="upload-status"></div>

							<label>Select video</label>
							<div id="file-container">
								<input type="file" name="file" id="file_id"/>
							</div>
							<!--<div class="clearfix">
								<div id='imgContainer' class="clearfix"></div>
							</div>		-->
							
							<!--<p class="file-container">Select video <input type="file" name="file" id="file_id"/></p>-->
							<div class="table">
								<ul>
									<li>
											<div id='imgContainer' class="clearfix albumContainer"></div>
										
									</li>
								</ul>
							</div>		

							<div class="slider-small">
							
							</div>
							<!-- <input type="hidden" value=<?php //echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/> -->
							
						
						</form>
						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-video">Save</a><a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-video">Cancel</a>';		
						?>
					</div>
							
								
						<script type="text/javascript">
							imgVideoUploader('video', 'pet-video'); // SUBIR IMG
						</script>