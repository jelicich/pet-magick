<?php	
session_start();

include_once('../php/classes/BOVideos.php');

var_dump($_POST);
		$v = new BOVideos;
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


