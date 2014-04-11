
					<div class="mod-header">
						<h2>Upload New Project</h2>
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
										<p id="file-container">Select pictures<input type="file" name="file" id="file_id"/></p>
									</li>
								</ul>
							</div>

							<div class="cont-tr-tit">
								<label for="pro-name">
									Project Name*
									<span class="hid-def"><span class="left-tr"></span>Mandatory field. 100 characters max.</span>
								</label> 
								<input type='text' class='form-element mandatory' name='name' id="pro-name"/>
								<label for="pro-description">
									Project description*
									<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
								</label> 
								<textarea class='form-element mandatory' name='description' id="pro-description"></textarea>
							</div>
							

							<?php
								echo '<a href="#'.$_GET['u'].'" class="btn" id="save-project">Save</a>';
								echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-project">Cancel</a>';
							?>
						</form>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'project'); 
						</script>

				