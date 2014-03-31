<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){		

	include_once "../php/classes/BOVideos.php";
	$v = new BOVideos;

	$videosList = $v->getVideosList();
	$t = sizeof($videosList);

	for($i=0; $i<$t; $i++){

		$title =  htmlspecialchars($videosList[$i]['TITLE']);
		$caption =  htmlspecialchars($videosList[$i]['CAPTION']);
		$srcImg = $videosList[$i]['THUMBNAIL'];
		$srcVideo = $videosList[$i]['VIDEO']; 
?>

	<li class="ie-play  videoMin">
		<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
			
			<span class='wrapper-play'>
				
				<span class="play"></span>
				
					<img src= <?php  echo 'video/'.$srcImg; ?> class='thumb-mid'/>

					<dl class='hidden'>
						<dt><?php echo $title; ?> </dt>
						<dd><?php echo  $caption; ?></dd>
					<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
					</dl>

			</span>
		</a>
	</li>


<?php

	}

}else{		
	
	include_once "../php/classes/BOVideos.php";
	$v = new BOVideos;

	$videosList = $v->getVideosByCategory($_POST['c']);
	$t = sizeof($videosList);

    //var_dump($videosList);
	for($i=0; $i<$t; $i++){

		$title =  htmlspecialchars($videosList[$i]['Videos'][0]['TITLE']);
		$caption =  htmlspecialchars($videosList[$i]['Videos'][0]['CAPTION']);
		$srcImg = $videosList[$i]['Videos'][0]['THUMBNAIL'];
		$srcVideo = $videosList[$i]['Videos'][0]['VIDEO']; 
?>

	<li class="ie-play  videoMin">
		<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
			
			<span class='wrapper-play'>
				
				<span class="play"></span>
				
					<img src= <?php  echo 'video/'.$srcImg; ?> class='thumb-mid'/>

					<dl class='hidden'>
						<dt><?php echo $title; ?> </dt>
						<dd><?php echo  $caption; ?></dd>
					<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
					</dl>

			</span>
		</a>
	</li>



<?php

	} // end for
}

    //include_once '../templates/Jquery_player.php'; 
?>


<script type="text/javascript">
	listByCategory('anticsModuleByCategory.php');
	//scroll_again('scrollable-module');
</script>

















