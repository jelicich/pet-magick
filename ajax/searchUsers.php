<?php

include '../php/classes/BOUsers.php';
$u = new BOUsers;

$r = $u->searchUsers($_POST['q'], $_POST['from'],28);

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

		if(isset($r[$i]['Cities']['City'])){

				$city = htmlspecialchars($r[$i]['Cities']['City']);
				$country = htmlspecialchars($r[$i]['Countries']['Country']);
		}else{
				$city = "??";
				$country = "??";

		}
	?>
		<li>
			<a href=<?php echo 'user-profile.php?u='.$r[$i]['ID_USER']; ?> >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
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

