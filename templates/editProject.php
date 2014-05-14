<?php

//var_dump($_GET["u"]); exit;
//include_once "../php/classes/BOProjects.php";
//$pro = new BOProjects;
$project = $pro->getProjectsById($_GET["pr"]);

//var_dump($project ); exit;

?>
					<div class="mod-header">
						<h2>Edit Project</h2>
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
								<input type='text' class='form-element mandatory' name='title' id="pro-name" value="<?php echo $project[0]['TITLE']; ?>" />
								<label for="pro-description">
									Project description*
									<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
								</label> 
								<textarea class='form-element mandatory' name='description' id="pro-description"><?php echo $project[0]['DESCRIPTION']; ?></textarea>
							</div>
							

							<?php
								echo '<a href="#'.$project[0]['ID_PROJECT'].'" class="btn" id="save-edit-project">Save</a>';
								echo '<a href="#'.$project[0]['USER_ID'].'" class="btn" id="cancel-edit-project">Cancel</a>';
							?>
						</form>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'edit-project'); 
						</script>

				