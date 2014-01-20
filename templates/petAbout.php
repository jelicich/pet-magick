							<?php
								$p = new BOPets;
								
								if(isset($_GET['p']))
									$userId = $_GET['p'];
								elseif(isset($_POST['p']))
									$userId = $_POST['p'];
								
								$p->getPetData($userId);
							?>

							<?php 
							if($p->isOwn())
							{
								echo '<a href="#'.$p->getId().'" class="btn btn-edit" id="edit-pet-profile">Edit</a>';
							}
							?>
							
							<div class="pic-caption pet-info">
								<a href=<?php echo '"'.$p->getPic().'"'; ?> ><img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/></a>
								<strong class="nickname"><?php echo $p->getName(); ?></strong>
								<ul>
									<li><span><strong>Breed: </strong><?php echo $p->getBreed();?></span></li>
									<li><span><strong>Traits: </strong><?php echo $p->getTraits();?></span></li>
								</ul>
							</div>
							
							<div class="bg-txt corregir">
								<p><?php echo $p->getStory();?></p>
							</div>

							<script type="text/javascript">
								editPetProfile();
							</script>