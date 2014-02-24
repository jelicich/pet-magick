<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){

		include_once "../php/classes/BOTributes.php";
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
		
}else{

		include_once "../php/classes/BOTributes.php";
		$tribute = new BOTributes;

		$allTributes = $tribute->getTributesByCat($_POST['c']);
		$t = sizeof($allTributes);
		$noRepeat = array();
		//var_dump($allTributes);

		for($i=0; $i<$t; $i++){

			$j = mt_rand(0, $t -1);
		
			if(isset($noRepeat) && in_array($j, $noRepeat) ){
				
				$i--;

			}else{

			$trId = $allTributes[$i]['ID_TRIBUTE'];
			

	        if(!isset($allTributes[$i]['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
			else{ $srcImg = 'img/pets/thumb/'.$allTributes[$i]['Pets']['Pics']['PIC']; }
			if(!isset($allTributes[$i]['Pets']['NAME'])){ $name = '?'; }
			else{ $name = $name = $allTributes[$i]['Pets']['NAME'];; }
			if(!isset( $allTributes[$i]['SINCE'])){ $since =  '?'; }
			else{ $since =  $allTributes[$i]['SINCE']; }
			if(!isset( $allTributes[$i]['THRU'])){ $thru =  '?'; }
			else{ $thru =  $allTributes[$i]['THRU']; }

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
		}// end else		
			}// end for
	}//end else
?>

<script type="text/javascript">
	listByCategory('tributesModuleByPets.php');
	scroll_again('scrollable-module');
</script>