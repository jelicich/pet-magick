<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){

		include_once "../php/classes/BOUsers.php";
		$p = new BOUsers;
		$usersList = $p->getUserList();
		$t = sizeof($usersList);
		$noRepeat = array();

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

			array_push($noRepeat, $j);
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
	}//end else
		}// end for
		
    }else{

		include_once "../php/classes/BOPets.php";
		$p = new BOPets;
		$usersList = $p->getPetsByCat($_POST['c']);
		$t = sizeof($usersList);
		$noRepeat = array();

		for($i=0; $i<$t; $i++){

			$j = mt_rand(0, $t -1);
		
			if(isset($noRepeat) && in_array($j, $noRepeat) ){
				
				$i--;

			}else{

			$name = $usersList[$j]['Users']['NAME'];
			$lastName = $usersList[$j]['Users']['LASTNAME'];
			$userId = $usersList[$j]['USER_ID'];

			if(!isset($usersList[$j]['Users']['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList[$j]['Users']['Pics']['PIC']; }
			if(!isset($usersList[$j]['Users']['Cities']['City'])){ $city = '?'; }
			else{ $city = $usersList[$j]['Users']['Cities']['City']; }
			if(!isset( $usersList[$j]['Users']['Countries']['Country'])){ $country =  '?'; }
			else{ $country =  $usersList[$j]['Users']['Countries']['Country']; }

			array_push($noRepeat, $j);
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

<script type="text/javascript">
	listByCategory('profilesModuleByPet.php');
</script>