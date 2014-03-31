<?php

include '../php/classes/BOUsers.php';
$u = new BOUsers;
$r = $u->searchUsers($_POST['q'], $_POST['from']);
if($_POST['rand'])
	shuffle($r);
for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Pics']))
	{
		$thumb = 'img/users/thumb/'.$r[$i]['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/users/thumb/default.jpg';	
	}
	?>
		<li>
			<a href="<?php echo "user-profile.php?u=".$r[$i]['ID_USER']; ?>" >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo  htmlspecialchars($r[$i]['NAME']." ".$r[$i]['LASTNAME']); ?> </dt>
					<dd><?php echo  htmlspecialchars($r[$i]['Cities']['City'].", ".$r[$i]['Countries']['Country']); ?></dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				</dl>
			</a>
		</li>
	<?php 
}

?>

