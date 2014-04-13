<?php

include '../php/classes/BOTributes.php';
$u = new BOTributes;

$r = $u->searchTributes($_POST['q'], $_POST['from'],28);

if($_POST['rand'])
	shuffle($r);
for($i = 0; $i < sizeof($r); $i++)
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
}

?>

