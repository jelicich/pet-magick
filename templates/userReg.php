			
	<?php 
	include('../php/classes/BOlocation.php');
	
	$country = new BOLocation;
	$countries = $country->countryList();

	//var_dump($countries);
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

			     		<div id="region-wrapper">
			     			<select id="region">
			     				<option disabled="disabled" selected="selected">Region</option>
			     			</select>
			     		</div>

		     			<div id="city-wrapper">
			     			<select id="city">
			     				<option disabled="disabled">City</option>
			     			</select>
			     		</div>


						<div class="grid_2 alpha">
							<label for="city">city</label>
							<input type="text" name="city" id="city" placeholder="city" style="width:100%"/>
						</div>

						
						



						<input type="button" id="reg" value="Sign up!" />
						<input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />


					</form>
					<input type="button" id="link" value="reg" />
					
				</div>

				<script type="text/javascript" id='jsreg'>

					byid('reg').onclick = function() {reg();}


					/*COMBO*/
					
					var country = byid('country');
					country.onchange = function()
					{
						var id;
						id = country.options[country.selectedIndex].value; 
						var vars = 'idCountry='+id;
						ajax('GET', 'ajax/selectRegions.php?'+vars, printRegions, false, true);
					};

					//el onchange de la region lo toma desde el div en vez desde el select (no sé porqué me pasó lo mismo cuando lo hice con jquery)
					var regionwr = byid('region-wrapper');
					var region = byid('region');
					regionwr.onchange = function()
					{
						//VERRR!!!!!!
						//las ciudades del combo no las muestra pq a get le llega la variable idRegion como "Region" (la palabra Region) en vez del ID de la región seleccionada en el paso anterior
						//Archivos: ajax/selectCities.php classes/BOlocation.php models/CountriesTable.php
						var id;
						id = region.options[region.selectedIndex].value; 
						var vars = 'idRegion='+id;
						ajax('GET', 'ajax/selectCities.php?'+vars, printCities, false, true);
					};

					/*LIB*/

					function printRegions()
					{
						var html = this.responseText;
						var wrap = byid('region-wrapper');
				 		wrap.innerHTML = html;
				 		//eval(byid('jslogout').innerHTML);

					}


					function printCities()
					{
						var html = this.responseText;
						var wrap = byid('city-wrapper');
				 		wrap.innerHTML = html;
				 		//eval(byid('jslogout').innerHTML); 	
					}
					/*

		            $('#categoria').change(function(){
		                id=$('#categoria option:selected').val();
		                $('#selmar').load('php/marca.php?id='+id);
		            });
		            $('#selmar').change(function(){
						//alert(id);
		                var ids=$('#m option:selected').val();
		                $('#selprod').load('php/producto.php?ids='+ids+'&id='+id);
		            });
					*/

				</script>


						