<?php

include '../php/classes/BOVideos.php';
$p = new BOVideos;
$r = $p->searchVideosByCategory($_POST['q'], $_POST['from'],28);

if($_POST['rand'])
	shuffle($r);

for($i = 0; $i < sizeof($r); $i++)
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
}

?>