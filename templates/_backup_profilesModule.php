
<?php
				
	include_once "php/classes/BOUsers.php";
	$p = new BOUsers;

	if(isset($_GET['s']) && $_GET['s'] == 0){

		$limit = 12;
	}else{

		$limit = 28;
	}

	$usersList = $p->getUserList($limit);
	
	$t = sizeof($usersList);
	//$noRepeat = array();
	
	for($i=0; $i<$t; $i++){

		$j = mt_rand(0, $t -1);
		
		if(isset($noRepeat) && in_array($j, $noRepeat) ){
			
			$i--;

		}else{

			$name = $usersList[$j]['NAME'];
			$lastName = $usersList[$j]['LASTNAME'];
			$userId = $usersList[$j]['ID_USER'];

			if(!isset($usersList[$j]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList[$j]['Pics']['PIC']; }
			if(!isset($usersList[$j]['Cities']['City'])){ $city = '?'; }
			else{ $city = $usersList[$j]['Cities']['City']; }
			if(!isset( $usersList[$j]['Countries']['Country'])){ $country =  '?'; }
			else{ $country =  $usersList[$j]['Countries']['Country']; }

			//array_push($noRepeat, $j);
		
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

		









