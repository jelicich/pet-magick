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
		?>
			<li>
				<a href="<?php echo "user-profile.php?u=".$r[$i]['ID_USER']; ?>" >
					<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
					<dl class='hidden'>
						<dt><?php echo  htmlspecialchars($r[$i]['NAME']." ".$r[$i]['LASTNAME']); ?> </dt>
						<dd><?php echo  $r[$i]['Cities']['City'].", ".$r[$i]['Countries']['Country']; ?></dd>
					<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
					</dl>
				</a>
			</li>
		<?php 
	}
}
