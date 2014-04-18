						
						<div class="mod-header">
							<h2>Upload Vet Talk article</h2>
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
									<label for="vet-title">
										Title*
										<span class="hid-def"><span class="left-tr"></span>Mandatory field. 100 characters max.</span>
									</label>
									<input type='text' class='form-element mandatory' name='title' id="vet-title"/>
									<label for="vet-cat">
										Category*
										<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
									</label>
									<select class='form-element mandatory' name='category' id="vet-cat">
										<?php
										include_once "../php/classes/BOAnimalCategories.php";
										$anCat = new BOAnimalCategories;
										$cats = $anCat->getCategories();
										for($i = 0; $i<sizeof($cats); $i++)
										{
											echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'">'.$cats[$i]['NAME'].'</option>';
										}
										?>
									</select>
				  					<label for="vet-content">
				  						Content*
				  						<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
				  					</label>
				  					<textarea class='form-element mandatory' name='content' id="vet-content"></textarea>
				  				</div>
								
			  					<?php
									echo '<a href="#'.$_GET['u'].'" class="btn" id="save-vet-talk">Save</a>';
									echo '<a href="#'.$_GET['u'].'" class="btn" id="cancel-vet-talk">Cancel</a>';
								?>
							</form>
						</div>
						<script type="text/javascript">
							imgVideoUploader('profile', 'vet-talk'); 
						</script>

				