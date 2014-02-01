<?php

session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	include_once "../php/classes/BOComments.php";

	$c = new BOComments;
	var_dump($_POST);
	$c->post($_POST);
	
}


?>