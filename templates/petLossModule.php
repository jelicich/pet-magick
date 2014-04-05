
<?php
	

	include_once "php/classes/BOTributes.php";
	$tribute = new BOTributes;

	$totalRec = $tribute->totalRecords('*');
	$totalPag = ceil($totalRec/28);

	$totalPag--;
	
	$firstPag = rand(0, $totalPag-1);
	
	$findme   = 'index.php';
	$src = strpos($_SERVER['PHP_SELF'], $findme);

	if($src === false)
		$r = $tribute->searchTributes('*',$firstPag*28,28);
	else
		$r = $tribute->searchTributes('*',$firstPag*28,12);

	if($r)
	{
		shuffle($r);
		for($i=0; $i < sizeof($r); $i++)
		{

			$allTributes = $tribute->getAllTributes();

			if(isset($noRepeat) && in_array( $allTributes['ID_TRIBUTE'], $noRepeat) )
			{
				
				$i--;

			}
			else
			{

				$trId = $allTributes['ID_TRIBUTE'];

		        if(!isset($allTributes['Pets']['Pics']['PIC'])){ $srcImg = 'img/pets/thumb/default.jpg'; }
				else{ $srcImg = 'img/pets/thumb/'.$allTributes['Pets']['Pics']['PIC']; }
				if(!isset($allTributes['Pets']['NAME'])){ $name = '?'; }
				else{ $name =  htmlspecialchars($allTributes['Pets']['NAME']); }
				if(!isset( $allTributes['SINCE'])){ $since =  '?'; }
				else{ $since =  $allTributes['SINCE']; }
				if(!isset( $allTributes['THRU'])){ $thru =  '?'; }
				else{ $thru =  $allTributes['THRU']; }
				if(!isset( $allTributes['TITLE'])){ $title =  '?'; }
				else{ $title =   htmlspecialchars($allTributes['TITLE']); }
				if(!isset( $allTributes['CONTENT'])){ $content =  '?'; }
				else{ $content =   htmlspecialchars($allTributes['CONTENT']); }

				array_push($noRepeat,$trId);

				$since = explode("-" , $since);
				$thru = explode("-" , $thru);
								
						
	?>

				<li>
					<a href= <?php echo "pet-tribute.php?t=".$trId; ?> >
						<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
						<dl class='hidden'>
							<dt><?php echo $name; ?> </dt>
							<dd><?php echo  $since[0]." - ".$thru[0];  ?></dd>
						</dl>
					</a>
				</li>
	<?php
			}//end else		
		}// end for

	}//end if

	?>

			
