<?php
	include 'php/classes/BOUsers.php';
	$u = new BOUsers;
	$totalRec = $u->totalRecords('*');
	$totalPag = ceil($totalRec/28);

	$totalPag--;
	$firstPag = rand(0, $totalPag);
	
	$findme   = 'index.php';
	$src = strpos($_SERVER['PHP_SELF'], $findme);

	if($src === false)
		$r = $u->searchUsers('*',$firstPag*28,28);
	else
		$r = $u->searchUsers('*',$firstPag*28,12);

if($r)
{
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

				$city = $r[$i]['Cities']['City'];
				$country = $r[$i]['Countries']['Country'];
		}else{
				$city = "??";
				$country = "??";

		}

		?>
			<li>
				<a href="<?php echo "user-profile.php?u=".$r[$i]['ID_USER']."&active=10"; ?>" >
					<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
					<dl class='hidden'>
						<dt><?php echo  htmlspecialchars($r[$i]['NAME']." ".$r[$i]['LASTNAME']); ?> </dt>
						<dd><?php echo  $city.", ".$country ?></dd>
					<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
					</dl>
				</a>
			</li>
		<?php 
	}
}
