<?php

//var_dump($_GET["u"]); exit;
//include_once "../php/classes/BOProjects.php";
//$pro = new BOProjects;
$organizations = $org->getOrganizationsById($_GET["org"]);

//var_dump($organizations ); exit;




?>
					<div class="mod-header">
						<h2>Edit Organization</h2>
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



							<div class="album-grid scrolleable">
							
										<ul class="clearfix">
								<?php

										for( $i=0; $i <sizeof($organizations[0]['Albums']["Pics"]); $i++ )
										{
								?>
										
											<li>
												
												<label>
													<img class="thumb-small" src=<?php echo '"img/organizations/thumb/'.$organizations[0]['Albums']["Pics"][$i]['PIC'].'"';?> /><br/>
													<input class="form-element" type="checkbox" name="delete-pic[]" value=<?php echo '"'.$organizations[0]['Albums']["Pics"][$i]['ID_PIC'].'"'; ?> />
													Delete
												</label>
												
											</li>
											
								<?php
										}//end for
								?>
										</ul>
							</div>








							<div class="cont-tr-tit">
								<label for="pro-name">
									Organization Name*
									<span class="hid-def"><span class="left-tr"></span>Mandatory field. 100 characters max.</span>
								</label> 
								<input type='text' class='form-element mandatory' name='title' id="pro-name" value="<?php echo $organizations[0]['NAME']; ?>" />
								<input type='hidden' class='form-element mandatory' name='albumId' id="pro-album" value="<?php echo $organizations[0]['ALBUM_ID']; ?>" />
								<label for="pro-description">
									Organization description*
									<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
								</label> 
								<textarea class='form-element mandatory' name='description' id="pro-description"><?php echo $organizations[0]['DESCRIPTION']; ?></textarea>
							</div>
							

							<?php
								echo '<a href="#'.$organizations[0]['ID_ORGANIZATION'].'" class="btn" id="save-edit-organization">Save</a>';
								echo '<a href="#'.$organizations[0]['USER_ID'].'" class="btn" id="cancel-edit-organization">Cancel</a>';
							?>
						</form>

					</div>
						<script type="text/javascript">
							imgVideoUploader('album', 'edit-organization'); 
						</script>

				