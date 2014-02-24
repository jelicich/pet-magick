

<?php

	include_once "php/classes/BOVideos.php";
	$v = new BOVideos;

	if($s == 'index')
		$count = 1;
	if($s == 'antics')
		$count = 2;

	for($i=0; $i< $count; $i++){ // la var $count viene de index o antics 

		$videosList = $v->getVideosRamdom();

		if(isset($noRepeatVideo) && $videosList['ID_VIDEO'] == $noRepeatVideo ){ //chequear si esto esta bien o es cualca
			// esto es para evvitar q se repitan los videos q vienen random
			$i--;

		}else{

		$noRepeatVideo = $videosList['ID_VIDEO'];
		$title = $videosList['TITLE'];
		$caption = $videosList['CAPTION'];
		$srcImg = $videosList['THUMBNAIL'];
		$srcVideo = $videosList['VIDEO']; 

		
//var_dump($videosList);
		if($s == 'antics'){
?>

		<li class='video'>
			<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
				<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
				<span class='wrapper-play'>
					<span class="play"></span>
					<img src= <?php  echo 'video/'.$srcImg; ?> class="thumb-big video-thumb"/>
				</span>

				<span class="video-last-caption">
					<h3><?php echo $title; ?></h3>
					<span><?php echo  $caption; ?></span>
				</span>
			</a>
		</li>

<?php

}else{

?>
	
		<a class="petVideo" href= <?php  echo 'video/'.$srcVideo; ?> >
			<!--Puse un div provisorio asi no llorisqueas jajaj. Cuando sepamos como vamos a tomar los valores con js y como mostrar el video lo acomodamos como corresponde. Q opinas? -->
			<span class='wrapper-play-index'>
				<span class="play-index"></span>
				<img src= <?php  echo 'video/'.$srcImg; ?> class="thumb-big video-thumb"/>
			</span>

		<!--	Ver como hacemos para mostrar esto en el index sin romper todo

			<span class="video-last-caption">
				<h3><?php //echo $title; ?></h3>
				<span><?php// echo  $caption; ?></span>
			</span>
		 -->
		</a>

<?php
}
  }// end else noRepet
	}// end for
?>

