<?php

include '../php/classes/BOProjects.php';
$p = new BOProjects;
$r = $p->searchProjects($_POST['q'], $_POST['from']);

for($i = 0; $i < sizeof($r); $i++)
{
	if(isset($r[$i]['Albums']['Pics']) && !empty($r[$i]['Albums']['Pics']))
	{
		$thumb = 'img/projects/thumb/'.$r[$i]['Pics']['PIC'];
	}
	else
	{
		$thumb = 'img/projects/thumb/default.jpg';	
	}
	?>
		<li>
			<a href="<?php echo 'projects.php?s=0&p='.$r[$i]['ID_PROJECT']; ?>" >
				<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt>
					<?php 
						if(strlen($r[$i]['TITLE']) == 15)
							echo substr($r[$i]['TITLE'],0,14).'...' ;
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