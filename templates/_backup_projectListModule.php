

<?php

	include_once "php/classes/BOProjects.php";
	include_once "php/classes/BOPics.php";

	$projects = new BOProjects;
	$pics = new BOPics;

if(!isset($_GET['p'])){

	
	if(isset($_GET['s']) && $_GET['s'] == 0){

		$limit = 3;
		echo "<ul class='mod-content pet-loss-mod-list'>";

	}else{

		$limit = 6;
		echo "<ul class='mod-content pet-loss-mod-list  scrollable-list'>";
	}

	$everyProject = $projects->getAllProjects($limit);
	//var_dump($everyProject);
	$t = sizeof($everyProject);
	$noRepeat = array();

	for ($i=0; $i < $t; $i++) { 

			$j = mt_rand(0, $t -1);
			
			if(isset($noRepeat) && in_array($j, $noRepeat) ){
				
				$i--;

			}else{

				$projectId = $everyProject[$j]['ID_PROJECT'];
				//$userId = $everyProject[$j]['USER_ID'];
				$albumId = $everyProject[$j]['ALBUM_ID'];

				$projectAlbum = $pics->table->getPicsByAlbum($albumId);

				if(!isset($projectAlbum[0]['THUMB'])){ $srcImg = 'img/projects/thumb/default.jpg'; }
				else{ $srcImg = 'img/projects/thumb/'.$projectAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
				if(!isset($everyProject[$j]['TITLE'])){ $title = '?'; }
				else{ $title = $everyProject[$j]['TITLE']; }
				if(!isset( $everyProject[$j]['DESCRIPTION'] )){ $description =  '?'; }
				else{ $description =  $everyProject[$j]['DESCRIPTION']; }

				array_push($noRepeat, $j);
?>
				<li class="clearfix">
					<img src= <?php echo $srcImg; ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3><?php echo $title; ?></h3>
						<p><?php echo $description; ?></p>
						<a href=<?php echo '#'.$projectId ?> class='linkToModule'>View post</a>
					</div>
				</li>
<?php
		}// end else
   	}// end for
}// end if get p

?>

</ul>