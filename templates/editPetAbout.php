
			
			<?php 
				
				//if($p->getPetList($_GET['p']))
				//{	
					//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
					if(isset($_GET['p']))
						$userId = $_GET['p'];
					elseif(isset($_POST['p']))
						$userId = $_POST['p'];

					echo '<a href="#'.$userId.'" class="btn btn-edit" id="save-edit-pet-about">Save</a><a href="#'.$userId.'" class="btn btn-cancel" id="cancel-edit-pet-about">Cancel</a>';		
					$p->getPetData($userId);

					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
					
							<!-- IMG UPLOADER -->
						<div id='imgContainer'></div>

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							
							<div class="clearfix">
								<p id="upload-status"></p>
							  	<pre id="result"></pre>
								
								<div class="pic-caption pet-info">
									<img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/>
									<?php
										if($p->hasPic())
										{
									?>
										<label>
											<input class="form-element" type="checkbox" name="delete-pic[]" value=<?php echo '"'.$p->getPicId().'"'; ?> />
											Delete
										</label>
									<?php
										}
									?>
									<select name="animal-category" class="form-element">
										<?php
										$cats = $ac->getCategories();
										for($i = 0; $i<sizeof($cats); $i++)
										{
											if($cats[$i]['ID_ANIMAL_CATEGORY'] == $p->getCategory())
											{
												echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'" selected="selected">'.$cats[$i]['NAME'].'</option>';
											}
											else
											{
												echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'">'.$cats[$i]['NAME'].'</option>';
											}
										}
										?>
									</select>

									<label for="pet-name">Name</label>
									<input type="text" class="form-element" name="name" id="pet-name" value=<?php echo '"'.$p->getName().'"' ?> />
									
									<label for="pet-breed">Breed</label>
									<input type="text" class="form-element" name="breed" id="pet-breed" value=<?php echo '"'.$p->getBreed().'"'?>/>

									<label for="pet-traits">Traits</label>
									<input type="text" class="form-element" name="traits" id="pet-traits" value=<?php echo '"'.$p->getTraits().'"'?>/>
									
								</div>
								
								<div class="bg-txt corregir">
									<label for="pet-story"><textarea class="form-element" name="story"><?php echo $p->getStory();?></textarea>
								</div>
							</div>
								
							<?php
							if($p->hasTribute($userId))
							{
								include_once '../php/classes/BOTributes.php';
								$tr = new BOTributes;
								$ar = $tr->getTribute($p->getTributeId());
							?>
								<div id="create-tribute">
									<label for="del-tribute"><input type="checkbox" id="del-tribute" class="form-element" name="delete-tribute" value=<?php echo '"'. $ar['ID_TRIBUTE'] .'"';?> /> Delete Tribute</label>
									
									<div id="hide-tribute">
										<label for="tr-title">Tribute title</label>
										<input type="text" name="tr-title" id="tr-title" value=<?php echo '"'.$ar['TITLE'].'"'; ?> />

										<label for="tr-msg">Message</label>
										<textarea name="tr-msg" id="tr-msg"><?php echo $ar['CONTENT'];?></textarea>

										<label for="tr-since">Since</label>
										<input type="text" name="tr-since" id="tr-since" readonly="readonly" value=<?php echo '"'.$ar['SINCE'].'"';?> />

										<label for="tr-thru">Gone</label>
										<input type="text" name="tr-thru" id="tr-thru" readonly="readonly" value=<?php echo '"'.$ar['THRU'].'"'; ?> />

									</div>
								</div>
							<?php
							}//end if
							else
							{
							?>
								<div id="create-tribute">
									<label for="chk-tribute"><input type="checkbox" id="chk-tribute" class="form-element" name="create-tribute"/> Create Tribute</label>
									
									<div id="hide-tribute" style="display:none">
										<label for="tr-title">Tribute title</label>
										<input type="text" name="tr-title" id="tr-title"/>

										<label for="tr-msg">Message</label>
										<textarea name="tr-msg" id="tr-msg"></textarea>

										<label for="tr-since">Since</label>
										<input type="text" name="tr-since" id="tr-since" readonly="readonly"/>

										<label for="tr-thru">Gone</label>
										<input type="text" name="tr-thru" id="tr-thru" readonly="readonly"/>

									</div>
								</div>

							<?php
							}
							?>

							<!-- VIDEO!!!
							<div class='video'>
								<?php
									$v = $p->getVideo();
									if($v)
									{
								?>
										<div class='wrapper-play'>
											<div class="play"></div>
									<img src=<?php echo '"'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
										</div>

										<div class="video-last-caption">
											<h3><?php echo $v['TITLE'] ?><span>2:12</span></h3>
											
										</div>
								<?php
									} //end if videos
								?>
							</div>
							-->


							<input type="hidden" value=<?php echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/>
						</form>
			<?php 
				//}//END IF pets
			?>

			<script type="text/javascript">
				imgVideoUploader('profile', 'pet-about'); // SUBIR IMG

				showTribute();
				//PASAR A LIB
				function showTribute()
				{
					var chkTribute = byid('chk-tribute');
					var div = byid('hide-tribute');
					var ins = div.getElementsByTagName('input');
					var txa = div.getElementsByTagName('textarea');

					chkTribute.onchange = function()
					{
						if(this.checked)
						{
							div.style.display = 'block';
							for(var i = 0; i < ins.length; i++)
							{
								ins[i].className = 'form-element';
							}
							txa[0].className = 'form-element';
						}
						else
						{
							div.style.display = 'none';
							for(var i = 0; i < ins.length; i++)
							{
								ins[i].removeAttribute('class');
							}
							txa[0].removeAttribute('class');
						}
							
					}	
				}

		
			
			   $("#tr-since").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-thru").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-since").css("cursor","pointer");
			   $("#tr-thru").css("cursor","pointer");
			   
			</script>
