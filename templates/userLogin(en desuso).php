			
				<div id="log-form">
					<form class="grid_4 push_6 clearfix" id="form-login">
						

						<div class="grid_2 alpha">
							<label for="email">e-mail</label>
							<input type="text" name="email" id="email" placeholder="e-mail" style="width:100%"/>
						</div>
						<div class="grid_2 omega">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" placeholder="Password" style="width:100%"/>
						</div>
						<input type="button" id="login" value="Login" />
						<input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />
					</form>
					
					
				</div>

				<script type="text/javascript" id='jslogin'>

					//======================PARA LOGUEARSE 
					byid('login').onclick = function() {login();}

				</script>
