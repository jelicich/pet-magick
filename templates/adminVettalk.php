								
								<?php
									if(isset($_POST['u']))
										$idUsr = $_POST['u'];
									elseif(isset($_GET['u']))
										$idUsr = $_GET['u'];
								?>
								
								<div class="scrollable-list-sections" id="adminVetArticle">
									<ul class='mod-content pet-loss-mod-list'>	
									
										<?php
										$list = $vt->getVetTalkListByUser($idUsr);
										$anchor = 'vet-talk.php?s=0&p=';

										if($list)
										{
											for($i=0; $i<sizeof($list); $i++)
											{

												$vet_title = htmlspecialchars($list[$i]['TITLE']);
												$vet_cont = htmlspecialchars($list[$i]['CONTENT']);
										?>
											<li class="clearfix">
												<img src= <?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
												<div class="content-description bg-txt">
													<h3><?php echo $vet_title;
													if(strlen($vet_title) == 65) echo '...';?></h3>
													<p><?php echo $vet_cont;
													if(strlen($vet_cont) ==125) echo '...';?></p>
													<a href=<?php echo $anchor.$list[$i]['ID_VET_TALK']."&active=4"; ?> class='linkToModule'>View post</a>

													<input type="button" value="Delete" name=<?php echo '"'.$list[$i]['ID_VET_TALK'].'"'; ?> class="btn btn-danger delete-vet-talk" />
													<!-- <a href=<?php //echo '"#'.$list[$i]['ID_VET_TALK'].'"'?> class="btn btn-danger delete-vet-talk">Delete</a> -->
												</div>
											</li>
									<?php
											}//end for
										}//end if
									?>
									</ul>
								</div>


								<input type="button" value="Create a new Article" name="<?php echo $idUsr ?>" class="btn btn-admin" id="upload-vet-talk" />
								<!-- <a href=<?php //echo '"#'.$idUsr.'"' ?> class="btn" id="upload-vet-talk">Create a new article</a> -->
								
<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			    	uploadVetTalk();
					deleteVetTalk();
			</script>
<?php
	}
?>
			<script type="text/javascript">
				start_scroll_profile('adminVetArticle', false);
			</script>
								