
<?php
	

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;

	if(isset($_GET['s']) && $_GET['s'] == 0){

		$limit = 5;
	}else{

		$limit = 28;
	}

	$allTributes = $tribute->getAllTributes($limit);
	$t = sizeof($allTributes);

	$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

		$j = mt_rand(0, $t -1);
		
		if(isset($noRepeat) && in_array($j, $noRepeat) ){
			
			$i--;

		}else{

		//$petId = $allTributes[$i]['Pets']['ID_PET'];
		$trId = $allTributes[$j]['ID_TRIBUTE'];

        if(!isset($allTributes[$j]['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
		else{ $srcImg = 'img/pets/thumb/'.$allTributes[$j]['Pets']['Pics']['PIC']; }
		if(!isset($allTributes[$j]['Pets']['NAME'])){ $name = '?'; }
		else{ $name = $name = $allTributes[$j]['Pets']['NAME'];; }
		if(!isset( $allTributes[$j]['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes[$j]['SINCE']; }
		if(!isset( $allTributes[$j]['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes[$j]['THRU']; }
		if(!isset( $allTributes[$j]['TITLE'])){ $title =  '?'; }
		else{ $title =  $allTributes[$j]['TITLE']; }
		if(!isset( $allTributes[$j]['CONTENT'])){ $content =  '?'; }
		else{ $content =  $allTributes[$j]['CONTENT']; }

		array_push($noRepeat, $j);
?>
	
				<li class="clearfix smaller">
					<img src= <?php  echo $srcImg; ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt corregir">
						<h3><?php echo $title; ?></h3>
						<p><?php echo $content; ?></p>
						<a href=<?php echo 'pet-tribute.php?t='.$trId ?> class='linkToModule'>View post</a>
					</div>
				</li>



<?php
	}//end else		
		}// end for



?>
