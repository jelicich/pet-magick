<div class="mod news short-profile-modules nogrid-mod" id="news-mod">

				<div class="mod-header">
					<h2>My Recent News</h2>
				
				<?php
					if(isset($_SESSION['id']))
					{
					
						if($u->isOwn())
						{							
				?>
							<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
								
								<li><a id="post-news" class="btn"  >Post news</a></li>
									<div id='pop-up-click' class='mod'>

											<form class='form' >
												<textarea id='news_content'></textarea>
												<input type='button' name='news' value='Post' id='news_button' />
											</form>
											<div class="arrow-top"></div>
									</div>
									
							</div>
				<?php
						}
					}
				?>
				</div>
				<div class="scrollable-list-sections" id="news">

				<ul class="mod-content clearfix">
					<?php 

						//$u = new BOUsers;
						

						if($n->getNews($_GET['u']))
						{
							$nw = $n->getNews($_GET['u']);
							
							for($i = 0; $i<sizeof($nw); $i++)
							{

							
								$dNewDate = strtotime($nw[$i]['DATE']);
        						 $date= date('l jS F Y', $dNewDate);
					?>



							<li class="clearfix">
								<div class="content-description bg-news">
									
									<p><?php echo  htmlspecialchars($nw[$i]['NEWS']); ?><p>
									<div>
										<span><small><?php echo $date; ?></small></span><br><!-- remove br!!!!!!! -->

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
					?>
							<li class="clearfix">
								<div class="content-description bg-news">
									
									<p>No news at the moment...<p>
									<div>
										<span><small></small></span><br><!-- remove br!!!!!!! -->

										
									</div>
								</div>
							</li>
					<?php
						}
					?>
				</ul>
			</div>
</div>


<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			   news();
			</script>

<?php
	}
?>
		<script type="text/javascript">
			start_scroll_profile('news', false);
        </script>
