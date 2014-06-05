				<div class="mod-header">
					<h2>Upload New Organization</h2>
				</div>						

				<div class="mod-content upload-org">

					<iframe name="iframe_IE" src="" style="display: none"></iframe> 

					<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
						<div id="upload-status"></div>
						<ul class="nav nav-tabs user-about-tabs">
							<li class="active"><a href="#org-info" data-toggle="tab">Information</a></li>
							<li><a href="#org-pics" data-toggle="tab">Pictures</a></li>
						</ul>
						<div class="tab-content">						  
						  	<div class="tab-pane active" id="org-info">
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
						  	</div>

						  	<div class="tab-pane" id="org-pics">
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
					echo '<a href="#'.$_GET['u'].'" class="btn" id="save-organization">Save</a>';
					echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-organization">Cancel</a>';
					?>
					
				</div>

				<script type="text/javascript">
					imgVideoUploader('album', 'organization'); 
					$('.table').mCustomScrollbar({
					    advanced:{
					        updateOnContentResize: true
					    },
					    theme:"light-thin"
					});
				</script>

				