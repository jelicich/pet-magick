<?php

if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	include_once "php/classes/BOProjects.php";
	include_once "php/classes/BOPics.php";

	$projects = new BOProjects;
	$pics = new BOPics;

	$featuredProjects = $projects->getProjectsRamdom();
	//var_dump($featuredProjects);
	$userId = $featuredProjects['USER_ID'];
	$albumId = $featuredProjects['ALBUM_ID'];

	$projectAlbum = $pics->table->getPicsByAlbum($albumId);
	
	if(!isset($projectAlbum[0]['THUMB'])){ $srcImg = 'img/projects/thumb/default.jpg'; }
	else{ $srcImg = 'img/projects/thumb/'.$projectAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
	if(!isset($featuredProjects['TITLE'])){ $title = '?'; }
	else{ $title = $featuredProjects['TITLE']; }
	if(!isset( $featuredProjects['DESCRIPTION'] )){ $description =  '?'; }
	else{ $description =  $featuredProjects['DESCRIPTION']; }

}else{
	
	if(isset($_GET['s']) && $_GET['s'] == 0){
		
		include_once "php/classes/BOProjects.php";
		include_once "php/classes/BOPics.php";

	}else{

		include_once "../php/classes/BOProjects.php";
		include_once "../php/classes/BOPics.php";
	}
	

	$projects = new BOProjects;
	$pics = new BOPics;
	$featuredProjects = $projects->getProjectsById($_GET['p']);
	//var_dump($featuredProjects);
	$userId = $featuredProjects[0]['USER_ID'];
	$albumId = $featuredProjects[0]['ALBUM_ID'];

	$projectAlbum = $pics->table->getPicsByAlbum($albumId);
	
	if(!isset($projectAlbum[0]['THUMB'])){ $srcImg = 'img/projects/thumb/default.jpg'; }
	else{ $srcImg = 'img/projects/thumb/'.$projectAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
	if(!isset($featuredProjects[0]['TITLE'])){ $title = '?'; }
	else{ $title = $featuredProjects[0]['TITLE']; }
	if(!isset( $featuredProjects[0]['DESCRIPTION'] )){ $description =  '?'; }
	else{ $description =  $featuredProjects[0]['DESCRIPTION']; }
	
} // end else


?>

<div class="mod-header">
		<h2><?php echo $title; ?></h2>
</div>
	
<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<img src= <?php echo $srcImg; ?> class="thumb-mid"/>
		<a href= <?php echo "user-profile.php?u=".$userId; ?> ><span>Contact user >></span></a>
	</div>
	
	<div class="bg-txt txt-wider">
		
		<p><?php echo $description; ?></p>

	</div>
	
</div>

<div class="slider-small">
	
	<ul class="clearfix">
<?php

	$t = sizeof($projectAlbum);

	for ($i=0; $i < $t; $i++) { 
		
		$srcImg = $projectAlbum[$i]['THUMB'];
	
?>
		<li>
			<a class='link-img' href= <?php echo "img/projects/".$srcImg ?> >
				<img class="thumb-mid" src= <?php echo 'img/projects/thumb/'.$srcImg; ?> />
			</a>
		</li>

<?php

	} // end for
?>
	</ul>	
</div>

<script type="text/javascript">
	modalImg();
</script>