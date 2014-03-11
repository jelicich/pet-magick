		<div class="mod grid_12 pet-loss-mod list">
			<div class="mod-header">
				<h2>Support mesagges</h2>

				<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
					<span id="leave-comment">Leave your comment</span>
						<div id='pop-up-click' class='mod grid_4 '>

							<?php
							if(isset($_SESSION['id']))
							{
							?>
							<form class="form" >  
						        <textarea id="comment-txt" placeholder="Your comment..." ></textarea>    
						        <input type="button" id="send-comment" value="Submit" class="btn" />  
						    	<input type="hidden" id="tr-id" value=<?php echo '"'.$_GET['t'].'"'; ?> />
						    </form> 
							<?php 
							}
							else
							{
							?>
								<p>You must be logged in to comment</p>
							<?php
							}
							?>
							<div class="arrow-top"></div>
						</div>
						
				</div>
			</div>

			<!-- comments -->
			<div class="scrollable-list" id="tributeList">
				<ul class="mod-content" id="comments-wrapper">
					<?php 
						if(sizeof($com) <= 0)
						{
					?>
							<li class="clearfix">
								<p>This tribute has no messages. Be the first one and leave a support message!</p>
							</li>
					<?php
						}
						for($i = 0; $i<sizeof($com); $i++)
						{						
					?>

							<li class="clearfix">
								<a href=<?php echo '"user-profile.php?u='.$com[$i]['Users']['ID_USER'] .'"' ?> ><img src=<?php echo '"'.$com[$i]['Users']['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/></a>
								<div class="content-description bg-txt">
									<h3><a href=<?php echo '"user-profile.php?u='.$com[$i]['Users']['ID_USER'] .'"' ?>><?php echo $com[$i]['Users']['NAME'].' '.$com[$i]['Users']['LASTNAME'] ?></a></h3>
									<p><?php echo $com[$i]['COMMENT']?></p>
									<span><?php echo $com[$i]['DATE']?></span>
								</div>
							</li>

					<?php 
						}//end for
					?>
				</ul>
			</div>
			<!-- END comments -->
		</div>
		<script type="text/javascript">
		//	start_scroll('scrollable-list');
		</script>