				<div id="admin" class="mod grid_12 clearfix profiles-mod">

					<div class="mod-header">
						<h2>Admin</h2>
					</div>
					
					<div class="mod-content clearfix">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#organization" data-toggle="tab">Organizations</a></li>
							<li><a href="#projects" data-toggle="tab">Projects</a></li>
						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							<li><a href="#vtarticles" data-toggle="tab">Vet Talk Articles</a></li>
							<li><a href="#vtquestions" data-toggle="tab">Vet Talk Questions</a></li>
						<?php
						}
						?>
						</ul><!-- end navtabs -->


						<div class="tab-content">
							<!-- ORGSS HERE -->
							<div class="tab-pane active" id="organization">
								<?php
									echo '<a href="#'.$_SESSION['id'].'" class="btn btn-edit" id="save-edit-user">Save</a>';	
									include_once 'php/classes/BOOrganizations.php';
									$org = new BOOrganizations;
									$list = $org->getOrgListByUser($_SESSION['id']);
									if($list)
									{
										echo '<ul>';
										for($i=0; $i<sizeof($list); $i++)
										{
								?>
										<li class="vet-q clearfix">
											<img src=<?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
											<div class="content-description bg-txt">
												<h3><?php echo $list[$i]['NAME']?></h3>
												<p><?php echo $list[$i]['DESCRIPTION'] //hacerle un substr?></p>
												<a href=<?php echo '"#'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger">Delete</a>
											</div>
										</li>
								<?php
										}//end for
										echo '</ul>';
									}//end if
								?>
								
								<div id='imgContainer'></div>

								<iframe name="iframe_IE" src="" style="display: none"></iframe> 

								<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

									<input type='text' class = 'form-element' name='name' />
									<textarea class = 'form-element' name='description'></textarea>
									<script type="text/javascript">
										imgVideoUploader('profile', 'organization'); 
									</script>

								</form>
							</div>
							

							<!-- PROJECTS HERE -->
							<div class="tab-pane" id="projects">
							</div>
							
						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							<!-- VET ARTICLES HERE -->
							<div class="tab-pane" id="vtarticles">
							</div>
							

							<!-- VET QUESTIONS HERE -->
							<div class="tab-pane" id="vtquestions">
								<?php
									include_once "php/classes/BOQuestions.php";
									$ques = new BOQuestions;
									$aq = $ques->getNewQuestions();
								?>
								<ul class="pet-loss-mod-list qa-list" id="comments-wrapper">
									<?php 
										if(sizeof($aq) > 0)
										{
											for($i = 0; $i<sizeof($aq); $i++)
											{						
									?>

												<li class="clearfix">
													<ul>
														<li class="vet-q clearfix">
															<a href=<?php echo '"user-profile.php?u='.$aq[$i]['Users']['ID_USER'] .'"' ?> ><img src=<?php echo '"'.$aq[$i]['Users']['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/></a>
															<div class="content-description bg-txt">
																<h3><a href=<?php echo '"user-profile.php?u='.$aq[$i]['Users']['ID_USER'] .'"' ?>><?php echo $aq[$i]['Users']['NAME'].' '.$aq[$i]['Users']['LASTNAME'] ?></a></h3>
																<p><?php echo $aq[$i]['QUESTION']?></p>
																<span><?php echo $aq[$i]['DATE']?></span>
															</div>
														</li>
														<li class="vet-a clearfix">
															<p>
																<textarea></textarea>
																<input type="hidden" value=<?php echo '"'.$aq[$i]['ID_QUESTION'].'"'?>/>
																<input type="button" value="Submit" class="submit-answer"/>
															</p>
														</li>
													</ul>
												</li>

									<?php 
											}//end for
										}//end if
										else
										{
											echo "<li>There are no unanswered questions</li>";
										}
									?>

								</ul>
							</div>
						<?php
						}
						?>
						</div><!-- end tab content -->

					</div><!-- end mod contet -->
					
				</div><!-- end admin -->