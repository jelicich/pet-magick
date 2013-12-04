<ul class="grid_4 push_6 clearfix" id="login-reg-btns">
	<li>
		<a href="#" id="link-reg" class="btn btn-danger btn-small">Sign up</a>
		<!-- hidden -->
		<div id="reg-form">
			<?php 
				include('php/classes/BOlocation.php');

				$country = new BOLocation;
				$countries = $country->countryList();

			?>
			<form class="clearfix" id="form-login">
				
				<div class="half">
					<div>
						<label for="name">Name*</label>
						<input type="text" name="name" id="name" placeholder="name" style="width:100%"/>
					</div>

					<div>
						<label for="lastname">Lastname*</label>
						<input type="text" name="lastname" id="lastname" placeholder="lastname" style="width:100%"/>
					</div>

					<div>
						<label for="nickname">Nickname*</label>
						<input type="text" name="nickname" id="nickname" placeholder="nickname" style="width:100%"/>
					</div>
				</div>

				<div class="half">
					<div>
						<label for="email">e-mail*</label>
						<input type="text" name="email" id="email" placeholder="email" style="width:100%"/>
					</div>

					<div>
						<label for="password">Password*</label>
						<input type="text" name="password" id="password" placeholder="password" style="width:100%"/>
					</div>

					<div>
						<label for="password2">Confirm password*</label>
						<input type="text" name="password2" id="password2" placeholder="password2" style="width:100%"/>
					</div>
				</div>

				<div id="country-wrapper">
					<select id="country" name="country">
	     				<option disabled="disabled" selected="selected">Country</option>
						<?php
							foreach ($countries as $key => $value) {
	     						echo '<option value="'.$value['CountryId'].'">'.$value['Country'].'</option>';
							}
					    ?>
					</select>
	     		</div>
	     		<!-- pasar estos displays al css -->
	     		<div id="region-wrapper" >
	     			<select id="region" style='display:none;'><!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
	     			</select>
	     		</div>

     			<div id="city-wrapper" >
     				<!-- pasar estos displays al css -->
	     			<select id="city" style='display:none;'> <!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
	     			</select>
	     		</div>
	     		<p>* Mandatory fields</p>
	     		<input type="button" id="reg" value="Sign up!" class="btn btn-danger" />
				<input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />

			</form>
			
		</div>

		<script type="text/javascript" id='jsreg'>

			byid('reg').onclick = function() { reg(); }
			countriesCombo();
			regionsCombo();

	    </script>

	</li>

	<li>
		<a href="#" id="link-login" class="btn btn-danger btn-small">Login</a>
		<!-- hidden -->
		<div id="log-form">
			<form class="clearfix" id="form-login">
				<div>
					<label for="email">e-mail</label>
					<input type="text" name="email" id="email-log" placeholder="e-mail" style="width:100%"/>
				</div>
				<div>
					<label for="password">Password</label>
					<input type="password" name="password" id="password-log" placeholder="Password" style="width:100%"/>
				</div>
				<input type="button" id="login" value="Login" class="btn btn-danger"/>
				<input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />
			</form>
		</div>
	</li>
</ul>

<script type="text/javascript">

	//======================DESPLIEGA REGISTRO
	var flagR = 0;
	byid('link-reg').onclick = function(){
		//ajax('POST', 'ajax/getReg.php', printReg, null, true);
		if(flagR == 0)
		{
			byid('reg-form').style.display = "block";
			flagR=1;
		}	
		else
		{
			byid('reg-form').style.display = "none";
			flagR = 0;
		}

		//ESCONDO EL OTRO POR LAS DUDAS
		byid('log-form').style.display = "none";
		flagL = 0;
	}

	//======================DESPLIEGA LOGIN
	var flagL = 0;
	byid('link-login').onclick = function()
	{
		//ajax('POST', 'ajax/getLogin.php', printLogin, null, true);
		if(flagL == 0)
		{
			byid('log-form').style.display = "block";
			flagL=1;
		}	
		else
		{
			byid('log-form').style.display = "none";
			flagL = 0;
		}

		//ESCONDO EL OTRO POR LAS DUDAS
		byid('reg-form').style.display = "none";
		flagR=0;
	}

	//======================PARA LOGUEARSE 
	byid('login').onclick = function(){ login(); }

</script>
