<div id='pet-video'>
		<?php
			
			$v = $p->getVideo();

			if($v)
			{

				if($p->isOwn())
				{
					echo '<a href="#'.$p->getId().'" class="btn" id="delete-pet-video">Delete video</a>';
				}
		?>
				
				<a class="petVideo video" id='unlinkPath' href= <?php  echo 'video/'.$v['VIDEO']; ?> >
					<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
					<span class='wrapper-play'>
						<span class="play"></span>
						<img src= <?php echo '"video/'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
					</span>

					<span class="video-last-caption">
						<h3><?php echo $v['TITLE']; ?></h3>
						<span><?php echo $v['CAPTION']; ?></span>
					</span>
				</a>
				
				
		<?php
			}else{

				if($p->isOwn())
				{
					echo '<a href="#'.$p->getId().'" class="btn" id="upload-pet-video">Upload Video</a>';
				}
			}
		?>
</div>