<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');

	$mssg = new BOMessages;

	$data = $_SESSION['id'];

	echo '["headers"=>';

	if($mssg->getHeaders($data))
		echo $mssg->getInbox();
	else
		echo $mssg->getErrors();

	echo ', "messages"=>';

	$from = $_POST['fromId'];

	if($mssg->getNewMessages($from))
		echo $mssg->getChat();
	else
		echo $mssg->getErrors();

	echo']';

?>