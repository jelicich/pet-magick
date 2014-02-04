<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){

		include_once "../php/classes/BOTributes.php";
		$tribute = new BOTributes;

		$allTributes = $tribute->getAllTributes();
		$t = sizeof($allTributes);
		$noRepeat = array();

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
</script>