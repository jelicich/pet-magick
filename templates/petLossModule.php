
<?php
		// REEMPLAZAR TODO ESTO POR MASCOTAS MUERTAS (tributos)
		// ESTO TRAE SOLO USUARIOS NORMALES Y TE LINKEA A SU PERFIL

	include_once "php/classes/BOUsers.php";
	$p = new BOUsers;

	$usersList = $p->getUserList();
	$t = sizeof($usersList);
	//var_dump($usersList);
	for($i=0; $i<$t; $i++){

		$name = $usersList[$i]['NAME'];
		$lastName = $usersList[$i]['LASTNAME'];
		$userId = $usersList[$i]['ID_USER'];

		if(!isset($usersList[$i]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
		else{ $srcImg = 'img/users/thumb/'.$usersList[$i]['Pics']['PIC']; }
		if(!isset($usersList[$i]['Cities']['City'])){ $city = '?'; }
		else{ $city = $usersList[$i]['Cities']['City']; }
		if(!isset( $usersList[$i]['Countries']['Country'])){ $country =  '?'; }
		else{ $country =  $usersList[$i]['Countries']['Country']; }
?>

	<li>
		<a href= <?php echo "user-profile.php?u=".$userId; ?> >
			<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
			<dl class='hidden'>
				<dt><?php echo $name." ".$lastName; ?> </dt>
				<dd><?php echo  $city.", ".$country; ?></dd>
			<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
			</dl>
		</a>
	</li>
<?php
				
		}// end for
		//var_dump($usersList);
?>

		
