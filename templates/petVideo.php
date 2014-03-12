						
					<div class="mod-header">
						<h2>Edit pet video</h2>
					</div>

					<div class="mod-content">

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 


						
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
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
							
							</div>
							<!-- <input type="hidden" value=<?php //echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/> -->
							
						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-video">Save</a><a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-video">Cancel</a>';		
						?>
						</form>
					</div>
							
								
						<script type="text/javascript">
							imgVideoUploader('video', 'pet-video'); // SUBIR IMG
						</script>