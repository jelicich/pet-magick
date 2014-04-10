<?php

include '../php/classes/BOPets.php';
$p = new BOPets;
$r = $p->searchPetsByCategory($_POST['q'], $_POST['from'],28);

if($_POST['rand'])
	shuffle($r);

for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Users']['Pics']))
	{
		$thumb = 'img/users/thumb/'.$r[$i]['Users']['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/users/thumb/default.jpg';	
	}
	
	if(isset($r[$i]['Cities']['City']))
	{

			$city = htmlspecialchars($r[$i]['Users']['Cities']['City']);
			$country = htmlspecialchars($r[$i]['Users']['Countries']['Country']);
	}else{
			$city = "??";
			$country = "??";

	}

	?>
		<li>
			<a href=<?php echo "user-profile.php?u=".$r[$i]['Users']['ID_USER']; ?> >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo  htmlspecialchars($r[$i]['Users']['NAME']." ".$r[$i]['Users']['LASTNAME']); ?> </dt>
					<dd><?php echo  $city.", ".$country; ?></dd>
					<dd>Has <strong><?php $qty = floatval($r[$i]['COUNT']); echo $qty ?></strong> <?php if($qty == 1) echo $string; else echo $string.'s';?></dd>
				</dl>
			</a>
		</li>
	<?php 
}

?>


