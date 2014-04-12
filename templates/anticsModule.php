<?php
	

	include_once "php/classes/BOVideos.php";
	$videos = new BOVideos;

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
		for($i=0; $i < sizeof($r); $i++)
		{

				$thumb = 'video/'.$r[$i]["THUMBNAIL"]; 
				$title = $r[$i]["TITLE"]; 
				$caption = $r[$i]["CAPTION"]; 
				$srcVideo = 'video/'.$r[$i]['VIDEO']; 
	
			
?>

	<li class="ie-play  videoMin">
		<a class="petVideo" href= <?php  echo $srcVideo; ?> >
			
			<span class='wrapper-play'>
				
				<span class="play"></span>
				
					<img src= <?php  echo $thumb; ?> class='thumb-mid'/>

					<dl class='hidden'>
						<dt><?php echo htmlspecialchars($title); ?> </dt>
						<dd><?php echo  htmlspecialchars($caption); ?></dd>
					<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
					</dl>

			</span>
		</a>
	</li>

<?php
			
		}// end for

	}//end if
?>
