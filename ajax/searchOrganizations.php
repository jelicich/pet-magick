<?php

include '../php/classes/BOOrganizations.php';
$o = new BOOrganizations;
$r = $o->searchOrganizations($_POST['q'], $_POST['from']);

for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Pics']))
	{
		$thumb = 'img/organizations/thumb/'.$r[$i]['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/organizations/thumb/default.jpg';	
	}
	?>
		<li>
			<a href="<?php echo 'organizations.php?s=0&p='.$r[$i]['ID_ORGANIZATION']; ?>" >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt>
					<?php 
						if(strlen($r[$i]['NAME']) == 15)
							echo substr($r[$i]['NAME'],0,14).'...' ;
						else
							echo $r[$i]['NAME'];
					?> 
					</dt>
					<dd>
					<?php 
						if(strlen($r[$i]['DESCRIPTION'])==35)
							echo substr($r[$i]['DESCRIPTION'],0,34).'...';
						else
							echo $r[$i]['DESCRIPTION'];
					 ?>
					</dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				</dl>
			</a>
		</li>
	<?php 
}

?>