<?php
	
	include_once "php/classes/BOVideos.php";
	$videos = new BOVideos;

	if($s == 'index')
		$count = 1;
	if($s == 'antics')
		$count = 2;

	$totalRec = $videos->totalRecords('*');
	$totalPag = ceil($totalRec/28);

	$totalPag--;
	
	$firstPag = rand(0, $totalPag-1);
	
	$findme   = 'index.php';
	$src = strpos($_SERVER['PHP_SELF'], $findme);

	if($src === false)
		$r = $videos->searchVideos('*',$firstPag*28,28);
	else
		$r = $videos->searchVideos('*',$firstPag*28,12);
//var_dump($r); exit;
	if($r)
	{
		shuffle($r);
		for($i=0; $i < $count; $i++)
		{

				$thumb = 'video/'.$r[$i]["THUMBNAIL"]; 
				$title = htmlspecialchars($r[$i]["TITLE"]); 
				$caption = htmlspecialchars($r[$i]["CAPTION"]); 
				$srcVideo = 'video/'.$r[$i]['VIDEO']; 
?>

		<li class='video'>
			<a class="petVideo" href= <?php  echo $srcVideo; ?> >
				<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
				<span class='wrapper-play'>
					<span class="play"></span>
					<img src= <?php  echo $thumb; ?> class="thumb-big video-thumb"/>

					<dl class='hidden'>
						<dt><?php echo $title; ?> </dt>
						<dd><?php echo  $caption; ?></dd>
					<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
					</dl>
				</span>
			</a>
		</li>


<?php

  		//}
	}
}
?>

