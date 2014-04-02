

<?php

	include_once "php/classes/BOProjects.php";
	include_once "php/classes/BOPics.php";

	$projects = new BOProjects;
	$pics = new BOPics;

//if(!isset($_GET['p'])){

	
	if(isset($_GET['s']) && $_GET['s'] == 0){

		$anchor = 'projects.php?s=0&p=';

		if(isset($_GET['p'])){
			
			$limit = 6; // esto es para q ande el scroll cuando vengo del index
			$anchor = '';
			echo "<ul class='mod-content pet-loss-mod-list'>";

		}else{

			$limit = 3;// esta es la lista de projects en el index
			
			echo "<ul class='mod-content pet-loss-mod-list ie-project'>";

		}

	}else{

		$limit = 6;// esta es la lista de projectos por default en projects
		$anchor = '';
		echo "<ul class='mod-content pet-loss-mod-list'>";
	}

	$t = sizeof($projects->howmuch_projects());
	
	if( $limit > $t){ $limit = $t; }

	$noRepeat = array();

	for ($i=0; $i < $limit; $i++) { 

			$everyProject = $projects->getProjectsRamdom();

			if(isset($noRepeat) && in_array( $everyProject['ID_PROJECT'], $noRepeat) ){
				
				$i--;

			}else{

				$projectId = $everyProject['ID_PROJECT'];
				//$userId = $everyProject['USER_ID'];
				$albumId = $everyProject['ALBUM_ID'];

				$projectAlbum = $pics->table->getPicsByAlbum($albumId);

				if(!isset($projectAlbum[0]['THUMB'])){ $srcImg = 'img/projects/thumb/default.jpg'; }
				else{ $srcImg = 'img/projects/thumb/'.$projectAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
				if(!isset($everyProject['TITLE'])){ $title = '?'; }
				else{ $title =  htmlspecialchars($everyProject['TITLE']); }
				if(!isset( $everyProject['DESCRIPTION'] )){ $description =  '?'; }
				else{ $description =   htmlspecialchars($everyProject['DESCRIPTION']); }

				array_push($noRepeat, $projectId);
?>
				<li class="clearfix">
					<img src= <?php echo $srcImg; ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3><?php echo $title;
							if(strlen($title)==40) echo '...';?>
						</h3>
						<p>
							<?php echo $description; 
							if(strlen($description)==125) echo '...';?>
						</p>
<?php
				if($anchor == ''){
?>
							<span id="<?php echo $anchor.$projectId; ?>" class='linkToModule' />View project</span>		
<?php			
				}else{
?>
							<a href=<?php echo $anchor.$projectId."&active=5"; ?> class='linkToModule'>View project</a>
<?php

				}

?>

						
						<!-- <a href=<?php //echo $anchor.$projectId; ?> class='linkToModule'>View project</a> -->

					</div>
				</li>
<?php
		}// end else
   	}// end for
//}// end if get p

?>

</ul>

