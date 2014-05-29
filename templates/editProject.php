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

					<div class="mod-content edit-pro">


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
										<input type='text' class='form-element mandatory' name='title' id="pro-name" value="<?php echo $project[0]['TITLE']; ?>" />
										<input type='hidden' class='form-element mandatory' name='albumId' id="pro-album" value="<?php echo $project[0]['ALBUM_ID']; ?>" />
										<label for="pro-description">
											Project description*
											<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
										</label> 
										<textarea class='form-element mandatory' name='description' id="pro-description"><?php echo $project[0]['DESCRIPTION']; ?></textarea>
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



									<div class="album-grid scrolleable">
									
												<ul class="clearfix">
										<?php

												for( $i=0; $i <sizeof($project[0]['Albums']["Pics"]); $i++ )
												{
										?>
												
													<li>
														
														<label>
															<img class="thumb-small" src=<?php echo '"img/projects/thumb/'.$project[0]['Albums']["Pics"][$i]['PIC'].'"';?> /><br/>
															<input class="form-element" type="checkbox" name="delete-pic[]" value=<?php echo '"'.$project[0]['Albums']["Pics"][$i]['ID_PIC'].'"'; ?> />
															Delete
														</label>
														
													</li>
													
										<?php
												}//end for
										?>
												</ul>
									</div>
							  	</div>

							</div>



							








							
							

							
						</form>

						<?php
							echo '<a href="#'.$project[0]['ID_PROJECT'].'" class="btn" id="save-edit-project">Save</a>';
							echo '<a href="#'.$project[0]['USER_ID'].'" class="btn" id="cancel-edit-project">Cancel</a>';
						?>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'edit-project'); 
							$('.table').mCustomScrollbar({
							    advanced:{
							        updateOnContentResize: true
							    },
							    theme:"light-thin"
							});
							start_scroll('scrolleable');
						</script>

				