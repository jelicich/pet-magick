				<div class="mod-header">
					<h2>My Pets</h2>

					<?php 

						if($u->isOwn())
						{
							echo '<li><a href="#'.$userId.'" class="btn" id="add-pet">Add pet!</a></li>';
						}

					?>
				</div>
				<div id="petScrollList" >

					<ul class="mod-content">
						<?php

							
							if($pets) 
							{
								
								for($i = 0; $i < sizeof($pets); $i++)
								{	
									

						?>
									<li class="pet-info">
										<div id="<?php echo $pets[$i]['ID_PET']; ?>" class="pet-link" style="cursor: pointer"> 
											<img src=<?php echo '"'.$pets[$i]['THUMB'].'"'?> class="thumb-small"/> 
										</div>

										<h3>
											<span id="<?php echo $pets[$i]['ID_PET']; ?>" class="pet-link" style="cursor: pointer"> 
												<?php echo $pets[$i]['NAME'] ?> 
											</span>
										</h3>

										<span>
										<?php 
											if(strlen($pets[$i]['BREED'])>= 10){
												echo substr($pets[$i]['BREED'], 0,10).'...';
											} 
											else
											{
												echo $pets[$i]['BREED'];
											}
										?></span>
						<?php
											if($u->isOwn())
											{
												echo '<a href='.'"#'.$pets[$i]['ID_PET'] .'" class="btn btn-danger delete-pet">Delete</a>';
											}
						?>	
									</li>
								
						<?php
								
								}//END FOR
							
							}//END IF 
						?>
						
					</ul>
			</div>



<?php
	if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
				deletePet();
				addPet();
			</script>

<?php
	}
?>
		<script type="text/javascript">
			 profile();
			 start_scroll_profile('petScrollList', true);
		</script>
