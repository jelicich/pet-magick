<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');

	$mssg = new BOMessages;

	$from = $_POST['fromId'];

	if($mssg->getNewMessages($from))
		echo $mssg->getChat();
	else
		echo $mssg->getErrors();


?>