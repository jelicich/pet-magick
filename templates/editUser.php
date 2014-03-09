
			
			
			<div class="mod-header">
				<h2>About me</h2>
			</div>
			<div class="mod-content clearfix">


					

					<iframe name="iframe_IE" src="" style="display: none"></iframe> 

					<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">
						 
						

						<!--
						<p id="upload-status"></p>
						<pre id="result"></pre>
						-->

					
					
						<img src=<?php echo '"'. $p->getThumb() .'"'; ?> class="thumb-mid"/>
						<?php
							if($p->hasPic())
							{
						?>
							<label>
								<input class="form-element" type="checkbox" name="delete-pic[]" value=<?php echo '"'.$p->getPicId().'"'; ?> />
								Delete
							</label>
						<?php
							}
						?>

						<div class="pic-caption">
						</div> <!-- END pic-caption -->
						
						<!-- IMG UPLOADER -->
						<div id='imgContainer'></div>

						<label id="file-container">Profile picture<input type="file" name="file" id="file_id"/></label>


						<label for="usr-name">Name</label><input class="form-element" type="text" value=<?php echo '"'.$p->getName().'"' ?> name="name" id="usr-name"/>
						<label for="usr-lastname">Lastname</label><input class="form-element" type="text" value=<?php echo '"'.$p->getLastname().'"' ?> name="lastname" id="usr-lastname"/>
						<label for="usr-nickname">Nickname</label><input disabled="disabled" type="text" value=<?php echo '"'.$p->getNickname().'"' ?> name="nickname" id="usr-nickname"/>
						<label for="usr-email">e-mail</label><input class="form-element" type="text" value=<?php echo '"'.$p->getEmail().'"' ?> name="email" id="usr-email"/>
						
						<?php
							$loc = $p->getLocation();
							if(empty($loc))
							{
						?>
								<div id="country-wrapper">
									<select class="form-element" id="country" name="country">
					     				<option disabled="disabled" selected="selected">Country</option>
										
										<?php
											foreach ($countries as $key => $value){
					     						echo '<option value="'.$value['CountryId'].'">'.$value['Country'].'</option>';
											}
									    ?>
									</select>
					     		</div>
					     		<!-- pasar estos displays al css -->
					     		<div id="region-wrapper" >
					     			<select class="form-element" id="region" name="region" style='display:none;'></select><!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
					     			
					     		</div>

				     			<div id="city-wrapper" >
				     				<!-- pasar estos displays al css -->
					     			<select class="form-element" id="city" name="city" style='display:none;'></select> <!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
					     			
					     		</div>
					    <?php
					     	} //end if
					     	else
					     	{
					    ?>
					    		<div id="country-wrapper">
									<select class="form-element" id="country" name="country">
					     				<option disabled="disabled">Country</option>
										
										<?php
											foreach ($countries as $key => $value){
					     						if($value['CountryId'] == $p->getCountryId())
					     						{
					     							echo '<option value="'.$value['CountryId'].'" selected="selected">'.$value['Country'].'</option>';	
					     						}
					     						else
					     						{
					     							echo '<option value="'.$value['CountryId'].'">'.$value['Country'].'</option>';
					     						}
											}
									    ?>
									</select>
					     		</div>

					     		<!-- pasar estos displays al css -->
					     		<div id="region-wrapper" >
					     			<select class="form-element" id="region" name="region">

					    <?php		
						     		$regions = $location->regionsByCountry($p->getCountryId());
						     		$reg = $p->getRegionId();

						     		if(empty($reg))
						     		{
						     			echo '<option disabled="disabled" selected="selected">Region</option>';	
						     		}
									else
									{
										echo '<option disabled="disabled">Region</option>';		
									}

									foreach ($regions as $key => $value) 
									{
										if($value['RegionID'] == $reg)
										{
											echo '<option value="'.$value['RegionID'].'" selected="selected">'.$value['Region'].'</option>';
										}
										else
										{
											echo '<option value="'.$value['RegionID'].'">'.$value['Region'].'</option>';
										}
									}
					    ?>		
					     		
					     			</select><!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
					     			
					     		</div>	

					     		<div id="city-wrapper">
					    <?php
					    		if(!empty($reg))
					    		{
					    ?>
				     				<!-- pasar estos displays al css -->
					     			<select class="form-element" id="city" name="city">
					    <?php
					    			$cities = $location->citiesByRegion($reg);
					    			$cit = $p->getCityId();
					    			if(empty($cit))
					    			{
					    				echo '<option disabled="disabled" selected="selected">City</option>';	
					    			}
					    			else
					    			{
					    				echo '<option disabled="disabled">City</option>';
					    			}
									
									foreach ($cities as $key => $value) 
									{
										if($value['CityId'] == $cit)
										{
											echo '<option value="'.$value['CityId'].'" selected="selected">'.$value['City'].'</option>';	
										}
										else
										{
											echo '<option value="'.$value['CityId'].'">'.$value['City'].'</option>';
										}
										
									}
						?>
									</select> 
						<?php
					    		}//end if
					    		else
					    		{
					    ?>
					    			<select class="form-element" id="city" name="city" style='display:none;'></select> <!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
					    <?php			
					    		} //end else
					    ?>	
					    		</div>
					    <?php
					    	} // end else
					    ?>

					    <div class="bg-txt">
							<textarea class="form-element" name="about" id="usr-about"><?php echo $p->getAbout() ?></textarea>
						</div>

					</form>
					
				
				
				
				<?php

				//if($p->isOwn())
				//{
					echo '<a href="#'.$_POST['u'].'" class="btn" id="save-edit-user">Save</a><a href="#'.$_POST['u'].'" class="btn" id="cancel-edit-user">Cancel</a>';	
				//}
				?>	
			</div>
			
			<script type="text/javascript">
				countriesCombo(); //====================== DESPLIEGA COMBOS
				regionsCombo(); //====================== DESPLIEGA REGIONES
				imgVideoUploader('profile', 'about'); // SUBIR IMG
			</script>
