				
				<!-- user menu -->
				<ul class="grid_4 push_6 clearfix" id="user-menu">
					<li>
						<a href="#" id="logout">Log out</a>
					</li>
					<li>
						<a href="#">My profile</a>
					</li>
					<li>
						<img src="img/users/thumb/1.jpg" />
						<span><?php echo $_SESSION['name'].' '.$_SESSION['lastname'] ?></span>
					</li>
				</ul>
				<!-- END user menu -->











<form method='' action=''>

	<input id='from' type='hidden' name='from' value=<?php echo '"'. $_SESSION['id'] . '"'; ?> />
	<input type='text' name='to' placeholder='to (email)' id='to' /><br>
	<input type='text' name='subject' placeholder='subject' id='subject' /><br>
	<textarea rows='5' cols='30' name='message' id='message'></textarea><br><br>

	<input type='button' value='Submit' id='submit'/>


</form>
				

			<script type="text/javascript" id="jslogout">

				byid('logout').onclick = function() {
					ajax('POST', 'ajax/logout.php', redirect, false, true);
				}

				inbox();

			</script>








