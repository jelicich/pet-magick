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
			<a href=<?php echo 'organizations.php?s=0&p='.$r[$i]['ID_ORGANIZATION'].'&active=6'; ?> >
				<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt>
					<?php 
							$s_name =  htmlspecialchars($r[$i]['NAME']);
							$s_desc =  htmlspecialchars($r[$i]['DESCRIPTION']);

						if(strlen($s_name) == 15)
							echo substr($s_name,0,14).'...' ;
						else
							echo $s_name;
					?> 
					</dt>
					<dd>
					<?php 
						if(strlen($s_desc)==35)
							echo substr($s_desc,0,34).'...';
						else
							echo $s_desc;
					 ?>
					</dd>
				<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
				</dl>
			</a>
		</li>
	<?php 
}

?>