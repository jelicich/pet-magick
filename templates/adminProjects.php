					
					<?php
						if(isset($_POST['u']))
							$idUsr = $_POST['u'];
						elseif(isset($_GET['u']))
							$idUsr = $_GET['u'];
					?>
					
				
							<div class="scrollable-list-sections" id="adminProject">
							<ul class='mod-content pet-loss-mod-list'>	
							
					<?php
								$list = $pro->getProjectListByUser($idUsr);
								$anchor = 'projects.php?s=0&p='; 

								if($list)
								{
								
									for($i=0; $i<sizeof($list); $i++){
					?>
									<li class="clearfix">
										<img src= <?php echo '"'.$list[$i]['Albums']['Pics'][0]['THUMB'] .'"'?> class="thumb-small side-img"/>
										<div class="content-description bg-txt">
											<h3><?php echo $list[$i]['TITLE'];
											if(strlen($list[$i]['TITLE'])==65) echo '...';?></h3>
											<p><?php echo $list[$i]['DESCRIPTION']; 
											if(strlen($list[$i]['DESCRIPTION'])==125) echo '...';?></p>
											<a href=<?php echo $anchor.$list[$i]['ID_PROJECT']; ?> class='linkToModule'>View project</a>

					<!--						<div id="pet-album">
												<div class="flexslider carousel">
													<ul class="slides">

					<?php
											/*for($j = 0; $j < sizeof($list[$i]['Albums']['Pics']); $j++)
											{
												echo '<li>
														<a href="'.$list[$i]['Albums']['Pics'][$j]['PIC'].'">
															<img src="'.$list[$i]['Albums']['Pics'][$j]['THUMB'].'"/>
														</a>
													  </li>';
											}
											*/
					?>
													</ul>
												</div>
											</div> 
					-->
											<input type="button" value="Delete" name="<?php echo $list[$i]['ID_PROJECT'] ?>" class="btn btn-danger delete-project" />
											<!-- <a href=<?php //echo '"#'.$list[$i]['ID_PROJECT'].'"'?> class="btn btn-danger delete-project">Delete</a> -->
										</div>
									</li>
					<?php
									}//end for
								}//end if
					?>
							</ul>
						</div>

						<input type="button" value="Create a new Project" name="<?php echo $idUsr ?>" class="btn" id="upload-project" />
						<!-- <a href=<?php //echo '"#'.$idUsr.'"' ?> class="btn" id="upload-project">Create a new Project</a> -->

	
<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			    	uploadProject();
					deleteProject();
			</script>
<?php
	}
?>
			<script type="text/javascript">
				//flexslider();		
				start_scroll_profile('adminProject', false);
			</script>
								