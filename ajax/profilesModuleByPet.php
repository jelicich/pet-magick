<?php
	if(isset($_POST['c']) && $_POST['c'] == 3){

		include_once "../php/classes/BOUsers.php";
		$p = new BOUsers;
		$usersList = $p->getUserList();
		$t = sizeof($usersList);

		for($i=0; $i<$t; $i++){

			$name = $usersList[$i]['NAME'];
			$lastName = $usersList[$i]['LASTNAME'];

			if(!isset($usersList[$i]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList[$i]['Pics']['PIC']; }
			if(!isset($usersList[$i]['Cities']['City'])){ $city = '?'; }
			else{ $city = $usersList[$i]['Cities']['City']; }
			if(!isset( $usersList[$i]['Countries']['Country'])){ $country =  '?'; }
			else{ $country =  $usersList[$i]['Countries']['Country']; }
?>

			<li>
				<a href='user-profiles.html'>
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
		
    }else{

		include_once "../php/classes/BOPets.php";
		$p = new BOPets;
		$usersList = $p->getPetsByCat($_POST['c']);

			$t = sizeof($usersList);

		for($i=0; $i<$t; $i++){
		
			$name = $usersList[$i]['Users']['NAME'];
			$lastName = $usersList[$i]['Users']['LASTNAME'];

			if(!isset($usersList[$i]['Users']['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
			else{ $srcImg = 'img/users/thumb/'.$usersList[$i]['Users']['Pics']['PIC']; }
			if(!isset($usersList[$i]['Users']['Cities']['City'])){ $city = '?'; }
			else{ $city = $usersList[$i]['Users']['Cities']['City']; }
			if(!isset( $usersList[$i]['Users']['Countries']['Country'])){ $country =  '?'; }
			else{ $country =  $usersList[$i]['Users']['Countries']['Country']; }
	?>

		<li>
			<a href='user-profiles.html'>
				<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo $name." ".$lastName; ?> </dt>
					<dd><?php echo  $city.", ".$country; ?></dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				
			</a>
		</li>
<?php
					
			}// end for
	}//end else
?>

<script type="text/javascript">
	usersByPet();
</script>