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
										<a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <img src=<?php echo '"'.$pets[$i]['THUMB'].'"'?> class="thumb-small"/> </a>
										<h3><a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <?php echo $pets[$i]['NAME'] ?> </a></h3>
										<span><?php echo $pets[$i]['BREED'] ?></span>
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

<script type="text/javascript">
	profile();
	deletePet();
	addPet();
	start_scroll_profile('petScrollList', true);
</script>