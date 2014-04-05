<?php

include '../php/classes/BOUsers.php';
$u = new BOUsers;

$r = $u->searchTribtes($_POST['q'], $_POST['from'],28);

if($_POST['rand'])
	shuffle($r);
for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Pics']))
	{
		$thumb = 'img/tributes/thumb/'.$r[$i]['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/tributes/thumb/default.jpg';	
	}

	?>
		<li>
			<a href=<?php echo 'pet-tribute.php?t='.$r[$i]['ID_TRIBUTE']; ?> >
				<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo  htmlspecialchars($r[$i]['NAME']." ".$r[$i]['LASTNAME']); ?> </dt>
					<dd><?php echo  $city.", ".$country; ?></dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				</dl>
			</a>
		</li>
	<?php 
}

?>

