
<div class="mod grid_8 projects-mod list">
	<div class="mod-header">
		<h2>Organization list</h2>
	</div>

	<div class="scrollable-list-sections" id="organizationList">
			<ul class='mod-content pet-loss-mod-list'>


<?php
				
	//include_once "php/classes/BOOrganizations.php";
	//include_once "php/classes/BOPics.php";

	//$org = new BOOrganizations;
	//$pics = new BOPics;


	$allOrg = $org->getAllOrganizations();
	//var_dump($allOrg); exit;
	$t = sizeof($allOrg);
	$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

		$j = mt_rand(0, $t -1);
		
		if(isset($noRepeat) && in_array($j, $noRepeat) ){
			
			$i--;

		}else{

			$orgId = $allOrg[$j]["ID_ORGANIZATION"];
			$orgAlbum = $pics->table->getPicsByAlbum($allOrg[$j]["ALBUM_ID"]);

			if(!isset($orgAlbum[0]['THUMB'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/organizations/thumb/'.$orgAlbum[0]['THUMB']; } 
			if(!isset($allOrg[$j]['NAME'])){ $name = '?'; }
			else{ $name =  htmlspecialchars($allOrg[$j]['NAME']); }
			if(!isset( $allOrg[$j]['DESCRIPTION'])){ $description =  '?'; }
			else{ $description =   $allOrg[$j]['DESCRIPTION']; }

			array_push($noRepeat, $j);
		
?>
	
				<li class="clearfix">
					<img src= <?php echo $srcImg; ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3><?php echo $name;
						if(strlen($name)==65) echo '...'; ?></h3>
						<p><?php echo $description;
						if(strlen($description) == 125) echo '...'; ?></p>

						<span id="<?php echo 'id_'.$orgId ?>" class='linkToModule' />View organization</span>
						<!-- <a href=<?php //echo '#'.$orgId ?> class='linkToModule'>View organization</a> -->
					</div>
				</li>
<?php
	}// end else		
		}// end for
?>

		</ul>
	</div>
</div>





