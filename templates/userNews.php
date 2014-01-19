<div class="mod profiles-mod nogrid-mod" id="news-mod">

				<div class="mod-header">
					<h2>My Recent News</h2>
				</div>

				<ul class="mod-content clearfix">
					<?php 

						$u = new BOUsers;
						$n = new BONews;
						
						if($n->getNews($_SESSION['id']))
						{
							$nw = $n->getNews($_SESSION['id']);
							
							for($i = 0; $i<sizeof($nw); $i++)
							{
					?>
								<li class="recent-news">
									<span><?php echo $nw[$i]['DATE']?></span>
									<p><?php echo $nw[$i]['NEWS']; ?><p>
									<?php 
									
									if($u->isOwn())
										echo "<a href='#". $nw[$i]['ID_NEWS'] ."' class='deleteNews btn btn-danger'>Delete</a> "; 
									?>

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
				<?php
					if($u->isOwn())
					{
						echo "	
								<textarea id='news_content'></textarea>
								<input type='button' name='news' value='Post' id='news_button' />
						";	
					}
				?>	
			</div>


<script type="text/javascript">
	news();
</script>