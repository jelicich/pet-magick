
		<?php
		    
			$u = new BOUsers;
			$n = new BONews;
			//$u->getUserData($_GET['u']);
			$u->getUserData($_SESSION['id']);
		?>

<div class="mod profiles-mod nogrid-mod" id="news-mod">
				<?php
					if($u->isOwn())
					{
						echo '<a href="#" class="btn btn-edit">Edit</a>';	
					}
				?>	
				<div class="mod-header">
					<h2>My Recent News</h2>
				</div>
				<ul class="mod-content clearfix">
					<?php 
						
						if($n->getNews($_SESSION['id']))
						{
							$nw = $n->getNews($_SESSION['id']);
							
							for($i = 0; $i<sizeof($nw); $i++)
							{
					?>
								<li class="recent-news">
									<span><?php echo $nw[$i]['DATE']?></span>
									<p><?php echo $nw[$i]['NEWS']; ?><p>
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


