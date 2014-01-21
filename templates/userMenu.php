				
			
				<!-- user menu -->

				<ul class="grid_4 push_6 clearfix" id="user-menu">
					<li>
						<a href="ajax/logout.php" id="logout">Log out</a>
					</li>
					<li>
						<a href="inbox.php">Inbox</a>
					</li>
					<li>
						
						<img src=<?php echo '"'. $_SESSION['thumb'] .'"'; ?> />
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










