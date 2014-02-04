		<div class="mod grid_12 vet-talk-mod">
			<div class="mod-header clearfix">
				<h2>Question time?</h2>
				
				<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
					<span id="leave-comment">Leave your comment</span>
						<div id='pop-up' class='mod grid_4 '>

							<?php
							if(isset($_SESSION['id']))
							{
							?>
							<form class="form" >  

							    <p class="text">  
							        <textarea id="comment-txt" placeholder="Your comment..." ></textarea>  
							    </p>  

							    <p class="submit">  
							        <input type="button" id="send-comment" value="Submit" class="btn" />  
							    </p>  
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
						</div>
						
				</div>
			</div>

			<ul class="mod-content pet-loss-mod-list qa-list" id="comments-wrapper">
				<?php 
					for($i = 0; $i<sizeof($com); $i++)
					{						
				?>

						<li class="clearfix">
							<ul>
								<li class="vet-q">
									<a href=<?php echo '"user-profile.php?u='.$com[$i]['Users']['ID_USER'] .'"' ?> ><img src=<?php echo '"'.$com[$i]['Users']['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/></a>
									<div class="content-description bg-txt">
										<h3><a href=<?php echo '"user-profile.php?u='.$com[$i]['Users']['ID_USER'] .'"' ?>><?php echo $com[$i]['Users']['NAME'].' '.$com[$i]['Users']['LASTNAME'] ?></a></h3>
										<p><?php echo $com[$i]['COMMENT']?></p>
										<span><?php echo $com[$i]['DATE']?></span>
									</div>
								</li>
								<li class="vet-a">
									<p>
										<?php 
										if(!empty($com[$i]['ANSWER']))
										{
											echo $com[$i]['ANSWER'];
											echo "<p>" . "</p>";
										}
										else
										{
											echo 'This question has not been answered yet';
										}
										?>
									</p>
								</li>
							</ul>
						</li>

				<?php 
					}//end for
				?>

				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						<li class="vet-a">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						
					</ul>
				</li>
				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						<li class="vet-a">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld sñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
					</ul>
				</li>
				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
					</ul>
				</li>
			</ul>
		</div>
