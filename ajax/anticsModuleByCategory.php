<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){		

	include_once "../php/classes/BOVideos.php";
	$v = new BOVideos;

	$videosList = $v->getVideosList();
	$t = sizeof($videosList);

	for($i=0; $i<$t; $i++){

		$title = $videosList[$i]['TITLE'];
		$caption = $videosList[$i]['CAPTION'];
		$srcImg = $videosList[$i]['THUMBNAIL'];
		$srcVideo = $videosList[$i]['VIDEO']; 
?>

	<li>
		<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
			<img src= <?php  echo 'video/'.$srcImg; ?> class='thumb-mid'/>
			<dl class='hidden'>
				<dt><?php echo $title; ?> </dt>
				<dd><?php echo  $caption; ?></dd>
			<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
			</dl>
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

		$title = $videosList[$i]['Videos'][0]['TITLE'];['Videos'];
		$caption = $videosList[$i]['Videos'][0]['CAPTION'];
		$srcImg = $videosList[$i]['Videos'][0]['THUMBNAIL'];
		$srcVideo = $videosList[$i]['Videos'][0]['VIDEO']; 
?>

	<li>
		
		<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
			<img class='videoThumb thumb-mid' src= <?php  echo 'video/'.$srcImg; ?> />
			<dl class='hidden'>
				<dt><?php echo $title; ?> </dt>
				<dd><?php echo  $caption; ?></dd>
			<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
			</dl>
		</a>
	</li>



<?php

	} // end for
}

    include_once '../templates/Jquery_player.php'; 
?>




















