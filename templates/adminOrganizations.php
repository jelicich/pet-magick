								
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
													<h3><?php echo $list[$i]['NAME'];
													if(strlen($list[$i]['NAME'])==65) echo '...';?></h3>
													<p><?php echo $list[$i]['DESCRIPTION']; 
													if(strlen($list[$i]['DESCRIPTION'])== 125) echo '...';?></p>
													<a href=<?php echo $anchor.$list[$i]['ID_ORGANIZATION']; ?> class='linkToModule'>View organization</a>

													
													<input type="button" value="Delete" name="<?php echo $list[$i]['ID_ORGANIZATION']; ?>" class="btn btn-danger delete-org" />
													<!-- <a href=<?php //echo '"#'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger delete-org">Delete</a> -->
												</div>
											</li>
									<?php
											}//end for
										}//end if
									?>
									</ul>
								</div>

								<input type="button" class="btn btn-admin" id="upload-organization" value="Create a new organization" name="<?php echo $idUsr; ?>" /> 
								<!--<a href=<?php //echo '"#'.$idUsr.'"' ?> class="btn" id="upload-organization">Create a new organization</a> -->
<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			    	uploadOrganization();
					deleteOrganization();
			</script>
<?php
	}
?>
			<script type="text/javascript">
				start_scroll_profile('adminOrg', false);
			</script>
								