<?php
        $p = new BOPets;
        
        if(isset($_GET['p']))
         $petID = $_GET['p'];
        elseif(isset($_POST['p']))
         $petID = $_POST['p'];
        
        $p->getPetData($petID);
       ?>


<?php
				$a = $v->getVideoByPet($p->getId());
				
				if($a){

					
						echo "<div class='videoCap'>
							<a class='petVideo video ppVideo' href= 'video/".$a[0]['VIDEO']."' >
								<span class='wrapper-play'>
									<span class='play'></span>
									<img src= video/".$a[0]['THUMBNAIL']." class='thumb-big video-thumb'/>
								</span>

								<dl class='hidden hidden-profile'>
									<dt>". htmlspecialchars($a[0]['TITLE'])."</dt>
									<dd>". htmlspecialchars($a[0]['CAPTION'])."</dd>
								</dl>
								
							</a>
							
							</div>";



				}else{
					
						echo "<span class='video ppVideo' >
								<span class='wrapper-play'>
									<span class='play videoDefault'></span>
								</span>	
							</span>";
				}
			?>



<div id='albumVideoButtons'>
	<?php
			if($p->isOwn())
			{
					echo '<a href="#'.$p->getId().'" class="btn" id="edit-pet-album">Edit album</a>';
				if($a){

					echo '<a href="#'.$p->getId().'" class="btn" id="delete-pet-video">Delete video</a>';
				    
				}else{
					
					echo '<a href="#'.$p->getId().'" class="btn" id="upload-pet-video">Upload Video</a>';

				}
			}
	?>
</div>
</div>
	<script type="text/javascript">
		deleteVideo();
		video();
	</script>