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
	else{ $title =  htmlspecialchars($featuredProjects['TITLE']); }
	if(!isset( $featuredProjects['DESCRIPTION'] )){ $description =  '?'; }
	else{ $description =   htmlspecialchars($featuredProjects['DESCRIPTION']); }

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
	else{ $title =  htmlspecialchars($featuredProjects[0]['TITLE']); }
	if(!isset( $featuredProjects[0]['DESCRIPTION'] )){ $description =  '?'; }
	else{ $description =   htmlspecialchars($featuredProjects[0]['DESCRIPTION']); }
	
} // end else


?>

<div class="mod-header">
		<h2><?php echo $title; ?></h2>
</div>
	
<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<img src= <?php echo $srcImg; ?> class="thumb-mid"/>
		<a href= <?php echo "user-profile.php?u=".$userId."&active=10"; ?> ><span>View user profile</span></a>
	</div>
	
	<div class="blind">
		<div class="scrollable-text" id="projectsText">
			<div class="bg-txt-featured-modules">
				
				<p><?php echo $description; ?></p>

			</div>
		</div>
	</div>

</div>


<?php

$t = sizeof($projectAlbum);
$flag = 6;
$default = 0;

if(isset($projectAlbum[0]['PIC'])){

?>

<div id="project-album">
<div class="flexslider carousel">
	<ul class="slides">
<?php

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

if($t < $flag){
	$default = $flag - $t;

	for ($i=0; $i < $default; $i++) { 

		echo "<li>
				<a class='link-img' href= 'img/projects/default.jpg' > 
					<img class='thumb-mid' src= 'img/projects/thumb/default.jpg' />
				</a> 
			</li>";
		
	}
}

	
?>
	</ul>	
</div>
</div>
<script type="text/javascript">
	flexslider();
</script>

<?php
} //end if
?>

<script type="text/javascript">
	//	modalImg();
	show_img('.link-img');
	start_scroll('scrollable-text', false);
</script>