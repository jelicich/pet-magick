
			
			<?php

				//if($p->isOwn())
				//{
					echo '<a href="#" class="btn btn-edit">Save</a>';	
				//}
			?>	
			<div class="mod-header">
				<h2>About me</h2>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					<img src=<?php echo '"'. $p->getThumb() .'"'; ?> class="thumb-mid"/>
					<label for="usr-name">Name</label><input type="text" value=<?php echo '"'.$p->getName().'"' ?> id="usr-name"/>
					<label for="usr-lastname">Lastname</label><input type="text" value=<?php echo '"'.$p->getLastname().'"' ?> id="usr-lastname"/>
					<label for="usr-nickname">Nickname</label><input type="text" value=<?php echo '"'.$p->getNickname().'"' ?> id="usr-nickname"/>
					
					<div id="country-wrapper">
						<select id="country" name="country">
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
		     			<select id="region" name="region" style='display:none;'></select><!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
		     			
		     		</div>

	     			<div id="city-wrapper" >
	     				<!-- pasar estos displays al css -->
		     			<select id="city" name="city" style='display:none;'></select> <!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
		     			
		     		</div>

					
				</div>
				<div class="bg-txt">
					<textarea id="usr-about"><?php echo $p->getAbout() ?></textarea>
				</div>
				<div id="user-extra">
					<!--
					<ul>
						<li><a href="#">Send me a message</a></li>
						<li><a href="#">My projects</a></li>
						<li><a href="#">My tributes</a></li>
					</ul>
					-->
				</div>
			</div>
