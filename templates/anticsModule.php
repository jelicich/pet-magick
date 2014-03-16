<?php

	include_once "php/classes/BOVideos.php";
	$v = new BOVideos;

	$videosList = $v->getVideosList();
	$t = sizeof($videosList);

	for($i=0; $i<$t; $i++){

		$title = $videosList[$i]['TITLE'];
		$caption = $videosList[$i]['CAPTION'];
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

	}// end for

