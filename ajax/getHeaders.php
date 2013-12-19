<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');
	include_once('../php/classes/BOConversations.php');

	$mssg = new BOConversations;

	$data = $_SESSION['id'];

	if($mssg->getHeaders($data))
	{
		echo $mssg->getInbox();
	}
	else
	{
		echo $mssg->getErrors();
	}

	$_SESSION['last-header'] = date('Y-m-d H:i:s');
	


?>