<?php	
session_start();

include_once('../php/classes/BOPets.php');
include_once('../php/classes/BOUsers.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['p']) )
	{
		$p = new BOPets;
		$owner = $p->getOwnerId($_POST['p']);
		if($owner != $_SESSION['id'])
		{
			echo 'Session ERROR';
			die;
		}
	}
	else
	{
		echo 'Session ERROR';
		die;
	}

	//---------------

	//ORDEN PARA BORRAR
	// borrar video

	// borrar fotos

	// borrar album

	// borrar mascotas

	

	var_dump($_POST);

}







//echo '<option value="0">Other</option>';