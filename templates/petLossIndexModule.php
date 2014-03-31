
<?php
	

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;


	$limit = 5;
	$t = sizeof($tribute->howmuch_tributes()); // ver si aca hace falta hacer esta consulta ya q es un valor chico y fijo
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
		else{ $name = htmlspecialchars($allTributes['Pets']['NAME']); }
		if(!isset( $allTributes['SINCE'])){ $since =  '?'; }
		else{ $since =  $allTributes['SINCE']; }
		if(!isset( $allTributes['THRU'])){ $thru =  '?'; }
		else{ $thru =  $allTributes['THRU']; }
		if(!isset( $allTributes['TITLE'])){ $title =  '?'; }
		else{ $title =  htmlspecialchars($allTributes['TITLE']); }
		if(!isset( $allTributes['CONTENT'])){ $content =  '?'; }
		else{ $content =  htmlspecialchars($allTributes['CONTENT']); }

		array_push($noRepeat,$trId);

?>
	
				<li class="clearfix smaller">
					<img src= <?php  echo $srcImg; ?> class="thumb-small side-img"/>
					<div class="content-description bg-txt corregir">
						<h3><?php echo $title; if(strlen($title)==25) echo '...'?></h3>
						<p><?php echo $content; if(strlen($content)==70) echo '...'; ?></p>
						<a href=<?php echo 'pet-tribute.php?t='.$trId ?> class='linkToModule'>View post</a>
					</div>
				</li>



<?php
	}//end else		
		}// end for



?>

