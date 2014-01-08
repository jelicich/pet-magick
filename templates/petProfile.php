			
			<?php
			//NO ANDA VER COMO VERIFICAR SI ESTA EN EL PERFIL DEL USUARIO CUANDO SE PIDEN LAS MASCOTAS POR AJAX
				/*
				if($p->isOwn())
				{
					echo '<a href="#" class="btn" style="position:absolute; z-index:100; right:10px; top:10px;">Edit</a>';	
				}
				*/
			?>	
			<?php 
					$p->getPetData($_GET['p']);
			?>		
					<div class="mod-header">
						<h2><strong class="nickname"><?php echo $p->getName(); ?> </strong>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
						<div class="pic-caption pet-info">
							<a href=<?php echo '"'.$p->getPic().'"'; ?> ><img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/></a>
							<ul>
								<li><span><strong>Breed: </strong><?php echo $p->getBreed();?></span></li>
								<li><span><strong>Traits: </strong><?php echo $p->getTraits();?></span></li>
							</ul>
						</div>
						
						<div class="bg-txt corregir">
							<p><?php echo $p->getStory();?></p>
						</div>
						
						<div class="slider-small">
							<?php
								if($p->getAlbumId())
								{
									$album = $p->getAlbum($p->getAlbumId());
							?>
									<ul class="clearfix">
							<?php

									for($i=0;$i<sizeof($album);$i++)
									{
							?>
									
										<li><a href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> ><img class="thumb-small" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> /></a></li>
										
							<?php
									}//end for
							?>
									</ul>
							<?php
								}//END IF
							?>
						</div>

						<div class='video'>
							<?php
								$v = $p->getVideo();
								if($v)
								{
							?>
									<div class='wrapper-play'>
										<div class="play"></div>
										<img src=<?php echo '"'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
									</div>

									<div class="video-last-caption">
										<h3><?php echo $v['TITLE'] ?><span>2:12</span></h3>
										<!--<span><strong>By: </strong> Petter Putter</span>-->
									</div>
							<?php
								} //end if videos
							?>
						</div>
					</div>

	
