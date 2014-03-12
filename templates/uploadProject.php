
					<div class="mod-header">
						<h2>Upload New Project</h2>
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
										<p id="file-container">Select pictures<input type="file" name="file" id="file_id"/></p>
									</li>
								</ul>
							</div>

							<label for="pro-name">Project Name*</label> 
							<input type='text' class='form-element mandatory' name='name' id="pro-name"/>
							<label for="pro-description">Project description*</label> 
							<textarea class='form-element mandatory' name='description' id="pro-description"></textarea>
							

							<?php
								echo '<a href="#'.$_GET['u'].'" class="btn" id="save-project">Save</a>';
								echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-project">Cancel</a>';
							?>
						</form>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'project'); 
						</script>

				