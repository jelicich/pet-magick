					
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

										$project_title =  htmlspecialchars($list[$i]['TITLE']);
										$project_desc =  htmlspecialchars($list[$i]['DESCRIPTION']);

										if(isset($list[$i]['Albums']['Pics'][0]['THUMB'])){

											$img = $list[$i]['Albums']['Pics'][0]['THUMB'];

										}else{

											$img = 'img/users/thumb/default.jpg';
										}
					?>
									<li class="clearfix">

										<img src= <?php echo '"'.$img.'"'?> class="thumb-small side-img"/>
										<div class="content-description bg-txt">
											<h3><?php echo $project_title;
											if(strlen($project_title) == 65) {echo '...';} ?></h3>
											<p><?php echo $project_desc; 
											if(strlen($project_desc) ==125) echo '...';?></p>
											<a href=<?php echo $anchor.$list[$i]['ID_PROJECT']."&active=5"; ?> class='linkToModule'>View project</a>

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

						<input type="button" value="Create a new Project" name="<?php echo $idUsr ?>" class="btn btn-admin" id="upload-project" />
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
								