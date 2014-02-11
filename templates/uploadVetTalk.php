						<?php
							echo '<a href="#'.$_GET['u'].'" class="btn" id="save-vet-talk">Save</a>';
							echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-vet-talk">Cancel</a>';
						?>

						<div id='imgContainer'></div>

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 

						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

							<input type='text' class = 'form-element' name='title' />
		  					<textarea class = 'form-element' name='content'></textarea>
							

						</form>
						<script type="text/javascript">
							imgVideoUploader('profile', 'vet-talk'); 
						</script>

				