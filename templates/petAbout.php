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
							
							<div class="pic-caption">
								<a class='link-img' href=<?php echo '"'.$p->getPic().'"'; ?> >
									<img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/>
								</a>

								<div class="pet-details">
									<strong class="nickname"><?php echo htmlspecialchars($p->getName()); ?></strong>
									<ul>
										<li><span><strong>Breed:</strong><?php echo htmlspecialchars($p->getBreed()); ?></span></li>
										<li><span><strong>Traits:</strong><?php echo htmlspecialchars($p->getTraits()); ?></span></li>
										<?php
											if($p->hasTribute($p->getId()))
											{
												echo '<li><a href="pet-tribute.php?t='.htmlspecialchars($p->getTributeId()).'" >View tribute</a></li>';
											}
										?>
									</ul>
								</div>
							</div>
							
							<div class="bg-pet-profile">
								<p><?php echo htmlspecialchars($p->getStory()); ?></p>
							</div>

							<script type="text/javascript">
								editPetProfile();
							</script>