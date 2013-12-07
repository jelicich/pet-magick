<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');

	$mssg = new BOMessages;

	$data = $_SESSION['id'];


	if($mssg->getMessages($data))
		echo $mssg->getInbox();
	else
		echo $mssg->getErrors();


?>