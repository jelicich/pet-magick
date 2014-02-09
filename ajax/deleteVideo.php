<?php	
session_start();

include_once('../php/classes/BOVideos.php');
$v = new BOVideos;

//var_dump($_POST);
				/*$owner = $p->getOwnerId($_POST['p']);
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
	}*/

	

	$v->delete($_POST['p']);


