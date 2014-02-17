<?php

session_start();
//var_dump($_POST);exit;



if($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	include_once "../../php/classes/BOPopups.php";
	$pop = new BOPopups;

	$ref = array(
		'section' => $_POST['section'],
		'content' => $_POST['content']
	);

	echo $pop->upload($ref);
	header("Location: ../pop-ups.php?active=1&tab=".$_POST['section']);

	
}
else
{
	echo "Request method error";
}


?>