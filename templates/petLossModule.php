
<?php
		// REEMPLAZAR TODO ESTO POR MASCOTAS MUERTAS (tributos)
		// ESTO TRAE SOLO USUARIOS NORMALES Y TE LINKEA A SU PERFIL

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;

	$limit = 28;
	$t = sizeof($tribute->howmuch_tributes());
	if( $limit > $t){ $limit = $t; }

	$noRepeat = array();
	
	for($i=0; $i < $limit; $i++){

		$allTributes = $tribute->getAllTributes();

		if(isset($noRepeat) && in_array( $allTributes['ID_TRIBUTE'], $noRepeat) ){
			
			$i--;

		}else{

		$trId = $allTributes['ID_TRIBUTE'];

        if(!isset($allTributes['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
		else{ $srcImg = 'img/pets/thumb/'.$allTributes['Pets']['Pics']['PIC']; }
		if(!isset($allTributes['Pets']['NAME'])){ $name = '?'; }
		else{ $name = $name = $allTributes['Pets']['NAME'];; }
		if(!isset( $allTributes['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes['SINCE']; }
		if(!isset( $allTributes['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes['THRU']; }
		if(!isset( $allTributes['TITLE'])){ $title =  '?'; }
		else{ $title =  $allTributes['TITLE']; }
		if(!isset( $allTributes['CONTENT'])){ $content =  '?'; }
		else{ $content =  $allTributes['CONTENT']; }

		array_push($noRepeat,$trId);
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

		
