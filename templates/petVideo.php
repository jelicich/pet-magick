						<?php
							echo '<a href="#'.$_GET['p'].'" class="btn" id="save-edit-pet-video">Save</a><a href="#'.$_GET['p'].'" class="btn" id="cancel-edit-pet-video">Cancel</a>';		
						?>

						<div id='imgContainer'></div>

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

							<div class="slider-small">
							
							</div>
							<!-- <input type="hidden" value=<?php //echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/> -->
							
						</form>
							
								
						<script type="text/javascript">
							imgVideoUploader('video', 'pet-video'); // SUBIR IMG
						</script>