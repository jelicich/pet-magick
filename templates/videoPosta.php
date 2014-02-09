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
?>

<a class="petVideo video" href= <?php  echo 'video/'.$a[0]['VIDEO']; ?> >
	<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
	<span class='wrapper-play'>
		<span class="play"></span>
		<img src= <?php echo '"video/'.$a[0]['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
	</span>

	<span class="video-last-caption">
		<h3><?php echo $a[0]['TITLE']; ?></h3>
		<span><?php echo $a[0]['CAPTION']; ?></span>
	</span>
</a>
<?php
	if($p->isOwn())
	{
		echo '<a href="#'.$p->getId().'" class="btn" id="delete-pet-video">Delete video</a>';
	}
?>
	<script type="text/javascript">
	deleteVideo();
	</script>