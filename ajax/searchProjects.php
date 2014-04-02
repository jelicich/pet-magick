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
			<a href=<?php echo 'projects.php?s=0&p='.$r[$i]['ID_PROJECT'].'&active=5'; ?> >
				<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
				<dl class='hidden'>
					<dt>
					<?php 

						$s_title =  htmlspecialchars($r[$i]['TITLE']);
						$s_desc =  htmlspecialchars($r[$i]['DESCRIPTION']);  

						if(strlen($s_title) == 15)
							echo substr($r[$i]['TITLE'],0,14).'...' ;
						else
							echo htmlspecialchars($r[$i]['NAME']);
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