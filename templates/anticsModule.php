<?php
				
	include_once "php/classes/BOVideos.php";
	$v = new BOVideos;

	$videosList = $v->getVideosList();
	$t = sizeof($videosList);

	for($i=0; $i<$t; $i++){

		$title = $videosList[$i]['TITLE'];
		$caption = $videosList[$i]['CAPTION'];
		$srcImg = $videosList[$i]['THUMBNAIL'];
?>

	<li>
		<a href= '#'>
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
/*
	$videosList = $p->getVideosList();
	$t = sizeof($getVideosList);
	var_dump($videosList);
	for($i=0; $i<$t; $i++){

		$name = $videosList[$i]['NAME'];
		$lastName = $videosList[$i]['LASTNAME'];
		$userId = $videosList[$i]['ID_USER'];

		if(!isset($videosList[$i]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
		else{ $srcImg = 'img/users/thumb/'.$videosList[$i]['Pics']['PIC']; }
		if(!isset($videosList[$i]['Cities']['City'])){ $city = '?'; }
		else{ $city = $videosList[$i]['Cities']['City']; }
		if(!isset( $videosList[$i]['Countries']['Country'])){ $country =  '?'; }
		else{ $country =  $videosList[$i]['Countries']['Country']; }
?>

	<li>
		<a href= <?php echo "user-profile.php?u=".$userId; ?> >
			<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
			<dl class='hidden'>
				<dt><?php echo $name." ".$lastName; ?> </dt>
				<dd><?php echo  $city.", ".$country; ?></dd>
			<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
			</dl>
		</a>
	</li>
<?php
				
		}// end for
		//var_dump($videosList);
		*/
		
		//var_dump($videosList);
?>

		

		



























<!--


		<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
						<dl class="hidden">
							<dt>Hey! let me pass -</dt>
							<dd><strong>By:</strong> Petter Putter</dd>
						</dl>
					</a>
				</li>-->