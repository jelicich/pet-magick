								
								<?php
									if(isset($_POST['u']))
										$idUsr = $_POST['u'];
									elseif(isset($_GET['u']))
										$idUsr = $_GET['u'];
								?>
								
								

								<div class="scrollable-list-sections" id="adminOrg">
									<ul class='mod-content pet-loss-mod-list'>	
									
										<?php
										$list = $org->getOrgListByUser($idUsr);
										$anchor = 'organizations.php?s=0&p=';

										if($list)
										{
											for($i=0; $i<sizeof($list); $i++)
											{
									?>
											<li class="clearfix">
												<img src= <?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
												<div class="content-description bg-txt">
													<h3><?php echo $list[$i]['NAME']?></h3>
													<p><?php echo $list[$i]['DESCRIPTION'] //hacerle un substr?></p>
													<a href=<?php echo $anchor.$list[$i]['ID_ORGANIZATION']; ?> class='linkToModule'>View post</a>
													<a href=<?php echo '"#'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger delete-org">Delete</a>
												</div>
											</li>
									<?php
											}//end for
										}//end if
									?>
									</ul>
								</div>

								<a href=<?php echo '"#'.$idUsr.'"' ?> class="btn" id="upload-organization">Create a new organization</a>


								<script type="text/javascript">
									uploadOrganization();
									deleteOrganization();
									start_scroll_profile('adminOrg', false);
									
								</script>