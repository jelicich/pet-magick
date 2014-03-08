<div class="mod news short-profile-modules nogrid-mod" id="news-mod">

				<div class="mod-header">
					<h2>My Recent News</h2>
				
				<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
					
					<li><a id="post-news" class="btn"  >Post news</a></li>
						<div id='pop-up-click' class='mod'>

							<?php
								if(isset($_SESSION['id']))
								{
								
									if($u->isOwn())
									{
										echo "	
												<textarea id='news_content'></textarea>
												<input type='button' name='news' value='Post' id='news_button' />
										";	
									}
								}
							?>
							<div class="arrow-top"></div>
						</div>
						
				</div>
				</div>
				<div class="scrollable-list-sections">

				<ul class="mod-content clearfix">
					<?php 

						//$u = new BOUsers;
						$n = new BONews;
						
						if($n->getNews($_GET['u']))
						{
							$nw = $n->getNews($_GET['u']);
							
							for($i = 0; $i<sizeof($nw); $i++)
							{
					?>



							<li class="clearfix">
								<div class="content-description bg-news">
									
									<p><?php echo $nw[$i]['NEWS']; ?><p>
									<div>
										<span><small><?php echo $nw[$i]['DATE']?></small></span><br><!-- remove br!!!!!!! -->

										<?php
										if($u->isOwn())
											echo "<a href='#". $nw[$i]['ID_NEWS'] ."' class='deleteNews btn btn-danger'>Delete</a> "; 
										?>
									</div>
								</div>
							</li>

					<?php 
							}//END FOR
						}//END IF
						else
						{
							echo '<li class="recent-news">The user does not have any update yet</li>';
						}
					?>
				</ul>
			</div>
</div>


<script type="text/javascript">
	news();
</script>