<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');

	$mssg = new BOMessages;

	$data = $_SESSION['id'];

	echo '[';

	if($mssg->getNewHeaders($data))
	{
		echo $mssg->getInbox();
		$_SESSION['last-header'] = date('Y-m-d H:i:s');
	}
	elseif($mssg->getNewHeaders($data) == null)
	{
		echo "null";
	}
	else
	{
		echo $mssg->getErrors();
	}
	
	echo ',';
	
	if($_SESSION['current-chat'])
	{
		if($mssg->getNewMessages($_SESSION['current-chat']))
			echo $mssg->getChat();
		elseif($mssg->getNewMessages($_SESSION['current-chat']) == null)
			echo "null";
		else
			echo $mssg->getErrors();
	}

	echo ']';

	
	//devuelve:
	/* 
	Ejemplo si tenes abierto el chat con un usuario y ese usuario te manda 2 mensajes:
	la primer posición es el encabezado
	la segunda los 2 mensajes q manda
	[
		Array[1]
			Objeto
		Array[2]
			Objeto
			Objeto
	]

	Si no hay mensajes de nadie
	[null, null]

	Si hay mensajes y no se tiene abierta la conversación y se reciben 2 mensajes
	[
		Array[2]
		null
	]
	*/
?>