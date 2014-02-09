						<?php
							echo '<a href="#'.$_GET['u'].'" class="btn" id="save-project">Save</a>';
							echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-project">Cancel</a>';
						?>

						<div id='imgContainer'></div>

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 

						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

							<input type='text' class = 'form-element' name='name' />
							<textarea class = 'form-element' name='description'></textarea>
							

						</form>
						<script type="text/javascript">
							imgVideoUploader('album', 'project'); 
						</script>

				