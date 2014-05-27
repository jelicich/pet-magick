
			
			<?php 
				
				//if($p->getPetList($_GET['p']))
				//{	
					//echo '<a href="#" class="btn btn-edit" id="save-edit-user">Save</a>';
					if(isset($_GET['p']))
						$userId = $_GET['p'];
					elseif(isset($_POST['p']))
						$userId = $_POST['p'];

					
					$p->getPetData($userId);

					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		

							<!-- IMG UPLOADER -->
					<div class="mod-header">
						<h2>Edit pet information</h2>
					</div>
					<div class="mod-content clearfix edit-pet">	

						<iframe name="iframe_IE" src="" style="display: none"></iframe> 
						
						<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
							
							<div class="clearfix">
								<!--
								<p id="upload-status"></p>
							  	<pre id="result"></pre>
							  	-->
							  	<div id="upload-status"></div>
								
								<ul class="nav nav-tabs user-about-tabs">
									<li class="active"><a href="#prof-pic" data-toggle="tab">Profile Picture</a></li>
									<li><a href="#per-info" data-toggle="tab">Pet Information</a></li>
									<li><a href="#tab-tribute" data-toggle="tab">Tribute</a></li>
								</ul>

								<div class="tab-content">
							
									<div class="tab-pane active clearfix" id="prof-pic">

										<div class="table">
											<ul class="clearfix">
												<li class="current-pic-cont">
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
												</li>
												<li class="new-pic-cont">
													<label>Select pet profile picture</label>
													<div id="file-container">
														<input type="file" name="file" id="file_id"/>
													</div>
													<div class="clearfix">
														<div id='imgContainer' class="clearfix"></div>
													</div>		
												</li>
											</ul>
										</div>

									</div><!-- end tab-pane -->

									<div class="tab-pane" id="per-info">
										<!-- -->
										<div class="table">
											<ul class="clearfix li-info">
												<li class="odd">								
													<label for="pet-name">
														Name*
														<span class="hid-def"><span class="left-tr"></span>Mandatory field. 15 characters max.</span>
													</label>
													<input type="text" class="form-element mandatory" name="name" id="pet-name" value=<?php echo '"'.htmlspecialchars($p->getName()).'"' ?> />
												</li>
												<li>
													<label for="pet-breed">
														Breed
														<span class="hid-def"><span class="left-tr"></span>25 characters max.</span>
													</label>
													<input type="text" class="form-element" name="breed" id="pet-breed" value=<?php echo '"'.htmlspecialchars($p->getBreed()).'"'?>/>
												</li>
												<li>
													<label for="pet-traits">
														Traits
														<span class="hid-def"><span class="left-tr"></span>50 characters max.</span>
													</label>
													<input type="text" class="form-element" name="traits" id="pet-traits" value=<?php echo '"'.htmlspecialchars($p->getTraits()).'"'?>/>
												</li>
												<li>
													<label for="animal-category">
														Animal category*
														<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
													</label>
													<select name="animal-category" class="form-element mandatory" id="animal-category">
														<?php

														$cats = $ac->getCategories();
														for($i = 0; $i<sizeof($cats); $i++)
														{
															if($cats[$i]['ID_ANIMAL_CATEGORY'] == $p->getCategory())
															{
																echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'" selected>'.$cats[$i]['NAME'].'</option>';
															}
															else
															{
																echo '<option value="'.$cats[$i]['ID_ANIMAL_CATEGORY'].'">'.$cats[$i]['NAME'].'</option>';
															}
														}
														?>
													</select>
												</li>	
											</ul>
										</div>
																		
										<label for="pet-story">Pet story</label>
										<textarea class="form-element" name="story"><?php echo $p->getStory() ?></textarea>
										<!-- -->
									</div><!-- end tab-pane -->

									<div class="tab-pane" id="tab-tribute">
										<?php
										if($p->hasTribute($userId))
										{
											include_once '../php/classes/BOTributes.php';
											$tr = new BOTributes;
											$ar = $tr->getTribute($p->getTributeId());
										?>
											<div id="create-tribute">
												<label for="del-tribute"><input type="checkbox" id="del-tribute" class="form-element" name="delete-tribute" class="form-element" value=<?php echo '"'. $ar['ID_TRIBUTE'] .'"';?> /> Delete Tribute</label>
												
												<div id="hide-tribute" class="table">										
													<div class="cont-tr-tit">
														<label for="tr-title">
															Tribute title*
															<span class="hid-def"><span class="left-tr"></span>Mandatory field. 90 characters max.</span>
														</label>
														<input type="text" name="tr-title" id="tr-title" value=<?php echo '"'.htmlspecialchars($ar['TITLE']).'"'; ?> class="form-element mandatory" />
													</div>
													<ul class="clearfix li-info since-gone">
														<li>
															<label for="tr-since">Since</label>
															<input type="text" name="tr-since" id="tr-since" readonly="readonly" value=<?php echo '"'.htmlspecialchars($ar['SINCE']).'"';?> class="form-element" />												
														</li>
														<li>
															<label for="tr-thru">Gone</label>
															<input type="text" name="tr-thru" id="tr-thru" readonly="readonly" value=<?php echo '"'.htmlspecialchars($ar['THRU']).'"'; ?> class="form-element" />
														</li>											
													</ul>
													<div class="cont-tr-tit">
														<label for="tr-msg">
															Message*
															<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
														</label>										
														<textarea name="tr-msg" id="tr-msg" class="form-element mandatory"><?php echo $ar['CONTENT'];?></textarea>
													</div>
													<input type="hidden" name="tr-user" value=<?php echo '"'.$ar['USER_ID'].'"';?> class="form-element"/>
													<input type="hidden" name="tr-id" value=<?php echo '"'.$ar['ID_TRIBUTE'].'"';?> class="form-element" />
												</div>
											</div>
										<?php
										}//end if
										else
										{
										?>
											<div id="create-tribute">
												<label for="chk-tribute"><input type="checkbox" id="chk-tribute" class="form-element" name="create-tribute"/> Create Tribute</label>									
												<div id="hide-tribute" style="display:none" class="table">										
													<div class="cont-tr-tit">
														<label for="tr-title">
															Tribute title*
															<span class="hid-def"><span class="left-tr"></span>Mandatory field. 90 characters max.</span>
														</label>
														<input type="text" name="tr-title" id="tr-title"/>										
													</div>
													<ul class="clearfix">
														<li class="odd">
															<label for="tr-since">Since</label>
															<input type="text" name="tr-since" id="tr-since" readonly="readonly"/>
														</li>
														<li class="even">
															<label for="tr-thru">Gone</label>
															<input type="text" name="tr-thru" id="tr-thru" readonly="readonly"/>		
														</li>
													</ul>	
													<div class="cont-tr-tit">
														<label for="tr-msg">
															Message*
															<span class="hid-def"><span class="left-tr"></span>Mandatory field.</span>
														</label>
														<textarea name="tr-msg" id="tr-msg"></textarea>																			
													</div>
												</div>
											</div>

										<?php
										}
										?>
									</div><!-- end tab-pane-->
								</div><!-- end tab-content -->
								
							</div><!-- end clearfix -->
								
										

							<!-- VIDEO!!!
							<div class='video'>
								<?php
									$v = $p->getVideo();
									if($v)
									{
								?>
										<div class='wrapper-play'>
											<div class="play"></div>
									<img src=<?php //echo '"'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
										</div>

										<div class="video-last-caption">
											<h3><?php //echo $v['TITLE'] ?><span>2:12</span></h3>
											
										</div>
								<?php
									} //end if videos
								?>
							</div>
							-->
							<input type="hidden" value=<?php echo '"'.$p->getOwner().'"';?> name="owner" class="form-element"/>
						</form>
						<?php
						echo '<a href="#'.$userId.'" class="btn" id="save-edit-pet-about">Save</a><a href="#'.$userId.'" class="btn" id="cancel-edit-pet-about">Cancel</a>';		
						?>
						
					</div>
				
			<?php 
				//}//END IF pets
			?>

			<script type="text/javascript">
				imgVideoUploader('profile', 'pet-about'); // SUBIR IMG
				showTribute();

			   $("#tr-since").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-thru").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-since").css("cursor","pointer");
			   $("#tr-thru").css("cursor","pointer");
			   $('.edit-scrollable').mCustomScrollbar({
				    advanced:{
				        updateOnContentResize: true
				    },
				    theme:"light-thin"
				});
			</script>
