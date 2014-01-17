
<!--VERSION PARA TRAER TODOS LOS USERS
	================================= -->

<ul class='grid-thumbs clearfix mod-content'> 

<?php
				
	include_once "php/classes/BOUsers.php";
	$p = new BOUsers;

	$array = $p->getUserList();
	$t = sizeof($array);
	//var_dump($array);
	for($i=0; $i<$t; $i++){

		$name = $array[$i]['NAME'];
		$lastName = $array[$i]['LASTNAME'];

		if(!isset($array[$i]['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
		else{ $srcImg = 'img/users/thumb/'.$array[$i]['Pics']['PIC']; }
		if(!isset($array[$i]['Cities']['City'])){ $city = '?'; }
		else{ $city = $array[$i]['Cities']['City']; }
		if(!isset( $array[$i]['Countries']['Country'])){ $country =  '?'; }
		else{ $country =  $array[$i]['Countries']['Country']; }
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
		//var_dump($array);
?>

</ul>			

<!--
	VERSION PARA CONSULTA POR MASCOTA
	=================================

<ul class='grid-thumbs clearfix mod-content'> 

<?php
				
	include_once "php/classes/BOPets.php";
	$p = new BOPets;

	$array = $p->getPetsByCat($_GET['c']);
	$t = sizeof($array);

	for($i=0; $i<$t; $i++){

		$name = $array[$i]['Users']['NAME'];
		$lastName = $array[$i]['Users']['LASTNAME'];

		if(!isset($array[$i]['Users']['Pics']['PIC'])){ $srcImg = 'img/users/thumb/default.jpg'; }
		else{ $srcImg = 'img/users/thumb/'.$array[$i]['Users']['Pics']['PIC']; }
		if(!isset($array[$i]['Users']['Cities']['City'])){ $city = '?'; }
		else{ $city = $array[$i]['Users']['Cities']['City']; }
		if(!isset( $array[$i]['Users']['Countries']['Country'])){ $country =  '?'; }
		else{ $country =  $array[$i]['Users']['Countries']['Country']; }
?>

	<li>
		<a href='user-profiles.html'>
			<img src= <?php  echo $srcImg; ?> class='thumb-mid'/>
			<dl class='hidden'>
				<dt><?php echo $name." ".$lastName; ?> </dt>
				<dd><?php echo  $city.", ".$country; ?></dd>
			<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
			<!--</dl>
		</a>
	</li>
<?php
				
		}// end for
		//var_dump($array);
?>

</ul>			

			
	-->	










