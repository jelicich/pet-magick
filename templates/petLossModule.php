
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

			if(isset($r[$i]['Pets']['Pics']))
			{
				$thumb = 'img/pets/thumb/'.$r[$i]['Pets']['Pics']['PIC'];
			}
			else
			{
				$thumb = 'img/pets/thumb/default.jpg';	
			}


			?>
				<li>
					<a href="<?php echo 'pet-tribute.php?t='.$r[$i]['ID_TRIBUTE']; ?>" >
						<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
						<dl class='hidden'>
							<dt><?php echo  htmlspecialchars($r[$i]['Pets']['NAME']); ?> </dt>
							<dd><?php echo  $r[$i]['SINCE']." - ".$r[$i]['THRU'];  ?></dd>
						</dl>
					</a>
				</li>
	<?php
			
		}// end for

	}//end if

	?>

			
