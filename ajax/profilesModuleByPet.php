<?php

	if(isset($_POST['c']) && $_POST['c'] == 3){

		include_once "../php/classes/BOUsers.php";
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

			$name = htmlspecialchars($usersList['NAME']);
			$lastName = htmlspecialchars($usersList['LASTNAME']);
			$userId = $usersList['ID_USER'];

			if(!isset($usersList['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList['Pics']['PIC']; }
			if(!isset($usersList['Cities']['City'])){ $city = '??'; }
			else{ $city = htmlspecialchars($usersList['Cities']['City']); }
			if(!isset( $usersList['Countries']['Country'])){ $country =  '??'; }
			else{ $country =  htmlspecialchars($usersList['Countries']['Country']); }

			array_push($noRepeat, $userId);
?>

			<li>
				<a href= <?php echo "user-profile.php?u=".$userId; ?> >
					<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
					<dl class='hidden'>
						<dt><?php echo  $name." ".$lastName; ?> </dt>
						<dd><?php echo   $city.", ".$country; ?></dd>
					</dl>
				</a>
			</li>
<?php
	}//end else
		}// end for
		
    }else{

		include_once "../php/classes/BOPets.php";
		$p = new BOPets;

		$limit = 28;
		$t = sizeof($p->howmuch_profiles_by_pet($_POST['c']));
		if( $limit > $t){ $limit = $t; }

		$usersList = $p->getPetsByCat($_POST['c'], $limit);
		//var_dump($usersList); exit;
		//$noRepeat = array();
		//var_dump($userslist); exit;
		for($i=0; $i < $limit; $i++){


			//if(isset($noRepeat) && in_array($j, $noRepeat) ){
				
			//	$i--;

			//}else{

			$name = htmlspecialchars($usersList[$i]['NAME']);
			$lastName = htmlspecialchars($usersList[$i]['LASTNAME']);
			$userId = $usersList[$i]['USER_ID'];

			if(!isset($usersList[$i]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList[$i]['Users']['Pics']['PIC']; }
			if(!isset($usersList[$i]['Cities']['City'])){ $city = '??'; }
			else{ $city = htmlspecialchars($usersList[$i]['Cities']['City']); }
			if(!isset( $usersList[$i]['Countries']['Country'])){ $country =  '??'; }
			else{ $country =  htmlspecialchars($usersList[$i]['Countries']['Country']); }

			//array_push($noRepeat, $userId);
	?>

			
		<li>
			<a href= <?php echo "user-profile.php?u=".$userId; ?> >
				<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo  $name." ".$lastName; ?> </dt>
					<dd><?php echo  $city.", ".$country; ?></dd>
				</dl>
			</a>
		</li>
<?php
		//}// end else		
			}// end for
	}//end else
?>

<script type="text/javascript">
	
	listByCategory('profilesModuleByPet.php');
	//scroll_again('scrollable-module');

	
</script>


<?php




	/*

	}else{

		include_once "../php/classes/BOPets.php";
		$p = new BOPets;

		$limit = 28;
		$t = sizeof($p->howmuch_profiles($_POST['c']));
		var_dump(expression)
		if( $limit > $t){ $limit = $t; }

		$noRepeat = array();

	
	for($i=0; $i < $limit; $i++){

		$usersList = $p->getPetsByCat($_POST['c']);

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
				
			</a>
		</li>
<?php
		}// end else		
			}// end for
	}//end else
?>

*/

?>