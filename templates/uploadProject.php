
					<div class="mod-header">
						<h2>Upload New Project</h2>
					</div>	

					<div class="mod-content upload-pro">


						<iframe name="iframe_IE" src="" style="display: none"></iframe> 

						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							<div id="upload-status"></div>
							<ul class="nav nav-tabs user-about-tabs">
								<li class="active"><a href="#pro-info" data-toggle="tab">Information</a></li>
								<li><a href="#pro-pics" data-toggle="tab">Pictures</a></li>
							</ul>
							<div class="tab-content">						  
						  		<div class="tab-pane active" id="pro-info">
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
						  		</div>

						  		<div class="tab-pane" id="pro-pics">
						  			
						  			<label class="file-container">Select pictures</label>
									<input type="file" name="file" id="file_id"/>
									
									<div class="table">
										<ul>
											<li>
												<div id='imgContainer' class="clearfix albumContainer"></div>
											</li>
										</ul>
									</div>

						  		</div>

						  	</div>



							

							
						</form>
						<?php
							echo '<a href="#'.$_GET['u'].'" class="btn" id="save-project">Save</a>';
							echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-project">Cancel</a>';
						?>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'project'); 

							$('.table').mCustomScrollbar({
							    advanced:{
							        updateOnContentResize: true
							    },
							    theme:"light-thin"
							});
						</script>

				