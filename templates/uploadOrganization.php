				<div class="mod-header">
					<h2>Upload New Organization</h2>
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
									<p id="file-container">Select picture<input type="file" name="file" id="file_id"/></p>
								</li>
							</ul>
						</div>

						<div class="cont-tr-tit">
							<label for="org-name">
								Organization Name*
								<span class="hid-def"><span class="left-tr"></span>Mandatory field. 100 characters max.</span>
							</label> 
							<input type='text' class='form-element mandatory' name='name' id="org-name"/>
							<label for="org-description">
								Description*
								<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
							</label>
							<textarea class='form-element mandatory' name='description' id="org-description"></textarea>
						</div>
						
						<?php
						echo '<a href="#'.$_GET['u'].'" class="btn" id="save-organization">Save</a>';
						echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-organization">Cancel</a>';
						?>

					</form>
				</div>

				<script type="text/javascript">
					imgVideoUploader('profile', 'organization'); 
				</script>

				