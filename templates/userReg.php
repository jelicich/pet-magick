			
<?php 
	include('../php/classes/BOlocation.php');

	$country = new BOLocation;
	$countries = $country->countryList();

?>

				<div id="user-reg">
					<form class="grid_4 push_6 clearfix" id="form-login">
						

						<div class="grid_2 alpha">
							<label for="name">name</label>
							<input type="text" name="name" id="name" placeholder="name" style="width:100%"/>
						</div>

						<div class="grid_2 alpha">
							<label for="lastname">lastname</label>
							<input type="text" name="lastname" id="lastname" placeholder="lastname" style="width:100%"/>
						</div>

						<div class="grid_2 alpha">
							<label for="nickname">nickname</label>
							<input type="text" name="nickname" id="nickname" placeholder="nickname" style="width:100%"/>
						</div>

						<div class="grid_2 alpha">
							<label for="email">email</label>
							<input type="text" name="email" id="email" placeholder="email" style="width:100%"/>
						</div>

						<div class="grid_2 alpha">
							<label for="password">password</label>
							<input type="text" name="password" id="password" placeholder="password" style="width:100%"/>
						</div>

						<div class="grid_2 alpha">
							<label for="password2">password-2</label>
							<input type="text" name="password2" id="password2" placeholder="password2" style="width:100%"/>
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

			     		<input type="button" id="reg" value="Sign up!" />
						<input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />

					</form>
					<input type="button" id="link" value="reg" />
					
				</div>

				<script type="text/javascript" id='jsreg'>

					byid('reg').onclick = function() {reg();}
					countriesCombo();
					regionsCombo();

			    </script>


						