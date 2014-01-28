				
			
				<!-- user menu -->

				<ul class="grid_4 push_6 clearfix" id="user-menu">
					<li>
						<a href="ajax/logout.php" id="logout">Log out</a>
					</li>
					<li>
						<a href="inbox.php">Inbox</a>
					</li>
					<li>
						<?php 
							if(!isset($_SESSION['thumb'])){

								$thumReg = 'img/users/thumb/default.jpg';

							}else{

								$thumReg = $_SESSION['thumb'];
							}
						?>
						<img src=<?php echo '"'. $thumReg  .'"'; ?> />
						<a href=<?php echo "user-profile.php?u=". $_SESSION['id'] ?> ><?php echo $_SESSION['name'].' '.$_SESSION['lastname'] ?></a>
					</li>
				</ul>
				<!-- END user menu -->





				
			
				<!-- 
					//include_once "php/classes/BOUsers.php";
					//$u = new BOUsers;
					//$u->getUserData($_SESSION['id']); ?>
					 <img src= <?php //echo '"'.  $u->getThumb() .'"'; ?> /> 
				-->










