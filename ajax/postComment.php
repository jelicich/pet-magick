<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	include_once "../php/classes/BOComments.php";

	$c = new BOComments;
	
	if($c->post($_POST))
	{
		echo $c->getSentComment();
	}
	
}
else
{
	echo "Request method error";
}


?>