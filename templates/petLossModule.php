
<?php
		// REEMPLAZAR TODO ESTO POR MASCOTAS MUERTAS (tributos)
		// ESTO TRAE SOLO USUARIOS NORMALES Y TE LINKEA A SU PERFIL

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;

	$allTributes = $tribute->getAllTributes();
	$t = sizeof($allTributes);
	//var_dump($allTributes);
	for($i=0; $i<$t; $i++){

		$petId = $allTributes[$i]['Pets']['ID_PET'];
		$trId = $allTributes[$i]['ID_TRIBUTE'];
		//$srcImg = $allTributes[$i]['Pets']['Pics']['PIC'];

        if(!isset($allTributes[$i]['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
		else{ $srcImg = 'img/pets/thumb/'.$allTributes[$i]['Pets']['Pics']['PIC']; }
		if(!isset($allTributes[$i]['Pets']['NAME'])){ $name = '?'; }
		else{ $name = $name = $allTributes[$i]['Pets']['NAME'];; }
		if(!isset( $allTributes[$i]['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes[$i]['SINCE']; }
		if(!isset( $allTributes[$i]['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes[$i]['THRU']; }
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
				
		}// end for
		//var_dump($usersList);*/



?>

		
