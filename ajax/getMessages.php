<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');

	$mssg = new BOMessages;

	$data = $_POST['fromId'];

	if($mssg->getMessages($data))
		echo $mssg->getChat();
	else
		echo $mssg->getErrors();


?>