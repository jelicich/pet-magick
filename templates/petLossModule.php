
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

		$petId = $allTributes[$i]['Pets']['ID_PET'];
		$trId = $allTributes[$i]['ID_TRIBUTE'];
		//$srcImg = $allTributes[$i]['Pets']['Pics']['PIC'];

        if(!isset($allTributes[$j]['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
		else{ $srcImg = 'img/pets/thumb/'.$allTributes[$j]['Pets']['Pics']['PIC']; }
		if(!isset($allTributes[$j]['Pets']['NAME'])){ $name = '?'; }
		else{ $name = $name = $allTributes[$i]['Pets']['NAME'];; }
		if(!isset( $allTributes[$j]['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes[$j]['SINCE']; }
		if(!isset( $allTributes[$j]['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes[$j]['THRU']; }

		array_push($noRepeat, $j);
?>

	<li>
		<a href= <?php echo "pet-tribute.php?t=".$trId; ?> >
			<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
			<dl class='hidden'>
				<dt><?php echo $name; ?> </dt>
				<dd><?php echo  $since; ?></dd>
				<dd><?php echo  $thru; ?></dd>
			<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
			</dl>
		</a>
	</li>
<?php
	}//end else		
		}// end for



?>

		
