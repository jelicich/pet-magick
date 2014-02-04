
<?php
		// REEMPLAZAR TODO ESTO POR MASCOTAS MUERTAS (tributos)
		// ESTO TRAE SOLO USUARIOS NORMALES Y TE LINKEA A SU PERFIL

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;

	$allTributes = $tribute->getAllTributes();
	$t = sizeof($allTributes);

	$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

		$j = mt_rand(0, $t -1);
		
		if(isset($noRepeat) && in_array($j, $noRepeat) ){
			
			$i--;

		}else{

		//$petId = $allTributes[$i]['Pets']['ID_PET'];
		$trId = $allTributes[$i]['ID_TRIBUTE'];

        if(!isset($allTributes[$j]['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
		else{ $srcImg = 'img/pets/thumb/'.$allTributes[$j]['Pets']['Pics']['PIC']; }
		if(!isset($allTributes[$j]['Pets']['NAME'])){ $name = '?'; }
		else{ $name = $name = $allTributes[$i]['Pets']['NAME'];; }
		if(!isset( $allTributes[$j]['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes[$j]['SINCE']; }
		if(!isset( $allTributes[$j]['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes[$j]['THRU']; }
		if(!isset( $allTributes[$i]['TITLE'])){ $title =  '?'; }
		else{ $title =  $allTributes[$i]['TITLE']; }
		if(!isset( $allTributes[$i]['CONTENT'])){ $content =  '?'; }
		else{ $content =  $allTributes[$i]['CONTENT']; }

		array_push($noRepeat, $j);
?>
	
				<li class="clearfix">
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
