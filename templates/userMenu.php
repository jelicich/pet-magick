				
			
				<!-- user menu -->

				<ul class="grid_5 push_5 clearfix" id="user-menu">
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
						<a href=<?php echo "user-profile.php?u=". $_SESSION['id'] ?> ><?php echo htmlspecialchars($_SESSION['name'].' '.$_SESSION['lastname']); ?></a>
						<?php

						if(isset($_SESSION['rank']) && $_SESSION['rank'] == 1)
						{
							if($_SERVER['REQUEST_METHOD'] == 'POST')
								include_once "../php/classes/BOQuestions.php";
							else
								include_once "php/classes/BOQuestions.php";
							
							$q = new BOQuestions;
							$n = $q->qtyNewQuestions();
							if($n[0]['COUNT']>0)
							{
						?>
							<i id="notification"><?php echo $n[0]['COUNT']?></i>
							<div id="notification-box">
								<p>There are <strong><?php echo $n[0]['COUNT']?></strong> unanswered questions in Vet Talk</p>
							</div>
							<script type="text/javascript">
								showNotification();
							</script>
						<?php
							}//end if sizeof
						}
						?>

					</li>
				</ul>
				<!-- END user menu -->





				
			
				<!-- 
					//include_once "php/classes/BOUsers.php";
					//$u = new BOUsers;
					//$u->getUserData($_SESSION['id']); ?>
					 <img src= <?php //echo '"'.  $u->getThumb() .'"'; ?> /> 
				-->










