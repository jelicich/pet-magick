		<?php
		    
			$u = new BOUsers;
			
			if(isset($_GET['u']))
				$userId = $_GET['u'];
			elseif(isset($_POST['u']))
				$userId = $_POST['u'];
			
			$u->getUserData($userId);
		?>
		<!-- about module -->
		<!--<div class="mod grid_12 profiles-mod nogrid-mod" id="user-about">-->
			<?php
				if($u->isOwn())
				{
					echo '<a href="#'.$userId.'" class="btn btn-edit" id="edit-user-info">Edit</a>';	
				}
			?>	
			<div class="mod-header">
				<h2>
					<strong class="nickname">
						<?php 
							$nick = $u->getNickname();
							if(empty($nick))
								echo $u->getName();
							else
								echo htmlspecialchars($nick);
						?>
					</strong>About me
				</h2>

				<?php

					if(isset($_SESSION['id'])){

							if(!$u->isOwn()){

									$favorites = $f->getFavorite($_SESSION['id']);
									$t = sizeof($favorites);
									$flag = false;

								if($t > 0){

									for ($i=0; $i < $t; $i++) { 
										

										if($favorites[$i]['ID_USER_FAVORITE'] ==  $_GET['u']){

											$flag = true;
											echo "<div class='myFav alert alert-success' ><span>favorite</span></div>";
											break;

										}
									}

									if($flag == false){
									?>
										<a id='addFavorite' href="<?php echo '#'.$_GET['u']; ?>" class='btn'>Add favorite</a>
										
									<?php
									}

								}else{

									?>
										<a id='addFavorite' href="<?php echo '#'.$_GET['u']; ?>" class='btn'>Add favorite</a>
										
									<?php
								}
							}
						}
					?>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					
					<a class='link-img'  href= <?php echo '"'.$u->getProfilePic().'"'; ?> >
						<img src=<?php echo '"'. $u->getThumb() .'"'; ?> class="thumb-mid" />
					</a>
					<h3><?php echo htmlspecialchars($u->getNameComp()); ?></h3>
					<span class="location"><?php echo htmlspecialchars($u->getLocation()); ?></span>
					<?php if(!$u->isOwn()) echo '<div><a class="btn send-message" href="inbox.php?to='.$userId.'"><img width="15" height="12" src="img/envelope.png"/> Send Message</a></div>';?>

				</div>


				<div class="blind">
					<div class="scrollable-about" id="aboutText">
						<div class="bg-txt-featured-modules">
							
							<p>
								<?php 
									$about = $u->getAbout();
									if(empty($about))
										echo 'The user has not entered any description yet';
									else
										echo nl2br($about);
								?>
							</p>

						</div>
					</div>
				</div>


				
				<!--
				<div id="user-extra">
					<ul>
						<li><a href="#">Send me a message</a></li>
						<li><a href="#">My projects</a></li>
						<li><a href="#">My tributes</a></li>
					</ul>
				</div>
				-->
			</div>
		<!--</div>-->

<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
			    editUserProfile();
			</script>

<?php
	}
?>
		<script type="text/javascript">
			
			show_img_up('#user-about');
			start_scroll('scrollable-about', false);

		</script>
		<!-- END about module -->