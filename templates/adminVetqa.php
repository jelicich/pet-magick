			<div class="scrollable-list-sections tab-pane " id="vtquestions">

						<?php
							include_once "php/classes/BOQuestions.php";
							$ques = new BOQuestions;
							$aq = $ques->getNewQuestions();
						?>	

						<ul class='mod-content pet-loss-mod-list'>	
									
						<?php 
							if(sizeof($aq) > 0)
							{
								for($i = 0; $i<sizeof($aq); $i++)
								{						
						?>

											<li class="clearfix">
												<img src= <?php echo '"'.$aq[$i]['Users']['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
												<div class="content-description bg-txt">
													<h3><a href=<?php echo '"user-profile.php?u='.$aq[$i]['Users']['ID_USER'] .'"' ?>><?php echo $aq[$i]['Users']['NAME'].' '.$aq[$i]['Users']['LASTNAME'] ?></a></h3>
												
													<p><?php echo $aq[$i]['QUESTION']?></p>
													<span><?php echo $aq[$i]['DATE']?></span>

													<div class="vet-a qa-profile ">
														<p>
															<textarea></textarea>
															<input type="hidden" value=<?php echo '"'.$aq[$i]['ID_QUESTION'].'"'?>/>
															<input type="button" value="Submit" class="submit-answer"/>
														</p>
													</div>

												</div>
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

							<script type="text/javascript">
									start_scroll_profile('vtquestions', false);
							</script>