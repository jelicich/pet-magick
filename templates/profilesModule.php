
<?php
				
	include_once "php/classes/BOUsers.php";
	$p = new BOUsers;

	if(isset($_GET['s']) && $_GET['s'] == 0){

		$limit = 12;

	}else{

		$limit = 28;
	}

	$t = sizeof($p->howmuch_profiles());
	if( $limit > $t){ $limit = $t; }
	$noRepeat = array();
	
	for($i=0; $i < $limit; $i++){

		$usersList = $p->getUserList();

		if(isset($noRepeat) && in_array( $usersList['ID_USER'], $noRepeat)){
			
			$i--;

		}else{

			$name = $usersList['NAME'];
			$lastName = $usersList['LASTNAME'];
			$userId = $usersList['ID_USER'];

			if(!isset($usersList['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList['Pics']['PIC']; }
			if(!isset($usersList['Cities']['City'])){ $city = '?'; }
			else{ $city = $usersList['Cities']['City']; }
			if(!isset( $usersList['Countries']['Country'])){ $country =  '?'; }
			else{ $country =  $usersList['Countries']['Country']; }

			array_push($noRepeat, $userId);
		
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
	}// end else		
		}// end for
		//var_dump($usersList);
?>

		









