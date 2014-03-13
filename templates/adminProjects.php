					
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
											<h3><?php echo $list[$i]['TITLE']?></h3>
											<p><?php echo $list[$i]['DESCRIPTION']; //hacerle un substr?></p>
											<a href=<?php echo $anchor.$list[$i]['ID_PROJECT']; ?> class='linkToModule'>View post</a>

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
											<a href=<?php echo '"#'.$list[$i]['ID_PROJECT'].'"'?> class="btn btn-danger delete-project">Delete</a>
										</div>
									</li>
					<?php
									}//end for
								}//end if
					?>
							</ul>
						</div>
						
						<a href=<?php echo '"#'.$idUsr.'"' ?> class="btn" id="upload-project">Create a new Project</a>
					<script type="text/javascript">
						uploadProject();
						deleteProject();
						 flexslider();
						start_scroll_profile('adminProject', false);
						
					</script>


