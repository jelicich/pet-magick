<?php
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST['u'] == $_SESSION['id'])
	{
		include_once "classes/BOTributes.php";
		$t = new BOTributes;
		$id = $t->createTribute($_POST);
		if($id)
		{
			header('Location: ../pet-tribute.php?t='.$id);
		}
		else
		{
			$err = $t->getErr();
			for($i = 0; $i < sizeof($err); $i++)
			{
				$e .= $err[$i]; 
			}
			header('Location: ../user-profile.php?u='.$_POST['u'].'&error=1'.$e.'#admin');
		}
	}
	else
	{
		echo 'There was a problem with your session';
		die;
	}
}

?>