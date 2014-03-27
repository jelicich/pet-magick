<?php

include '../php/classes/BOPets.php';
$p = new BOPets;
$r = $p->searchPets($_POST['q'], $_POST['from']);

for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Pics']))
	{
		$thumb = 'img/pets/thumb/'.$r[$i]['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/pets/thumb/default.jpg';	
	}
	?>
		<li>
			<a href="<?php echo "user-profile.php?u=".$r[$i]['Users']['ID_USER'].'&p='.$r[$i]['ID_PET']; ?>" >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt><?php echo $r[$i]['NAME']." | ".$r[$i]['AnimalCategories']['NAME']; ?> </dt>
					<dd><?php echo  $r[$i]['BREED'] ?></dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				</dl>
			</a>
		</li>
	<?php 
}

?>