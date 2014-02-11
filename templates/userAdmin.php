				<div id="admin" class="mod grid_12 clearfix profiles-mod">

					<div class="mod-header">
						<h2>Admin</h2>
					</div>
					
					<div class="mod-content clearfix">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#organization" data-toggle="tab">Organizations</a></li>
							<li><a href="#project" data-toggle="tab">Projects</a></li>
						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							<li><a href="#vet-talk" data-toggle="tab">Vet Talk Articles</a></li>
							<li><a href="#vtquestions" data-toggle="tab">Vet Talk Questions</a></li>
						<?php
						}
						?>
						</ul><!-- end navtabs -->


						<div class="tab-content">
							




							<!-- ORGSS HERE -->
							<div class="tab-pane active" id="organization">
								
								<?php
									include_once 'php/classes/BOOrganizations.php';
									$org = new BOOrganizations;
									include_once 'templates/adminOrganizations.php';
								?>
								
							</div>
							




							<!-- PROJECTS HERE -->
							<div class="tab-pane" id="project">

								<?php
									include_once 'php/classes/BOProjects.php';
									$pro = new BOProjects;
									include_once 'templates/adminProjects.php';
								?>

							</div>
						






						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							



							<!-- VET ARTICLES HERE -->
							<div class="tab-pane" id="vet-talk">
								<?php
									include_once 'php/classes/BOVettalk.php';
									$vt = new BOVettalk;
									include_once 'templates/adminVettalk.php';
								?>
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

				<script type="text/javascript">


				</script>
