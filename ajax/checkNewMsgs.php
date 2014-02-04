<?php 

	session_start();

	include_once('../php/classes/BOMessages.php');
	include_once('../php/classes/BOConversations.php');

	$conv = new BOConversations;
	$mssg = new BOMessages;


	$data = $_SESSION['id'];

	echo '[';

	if($conv->getNewHeaders($data))
	{
		echo $conv->getInbox();
		$_SESSION['last-header'] = date('Y-m-d H:i:s');
	}
	elseif($conv->getNewHeaders($data) === false)
	{
		echo $mssg->getErrors();	
	}
	else
	{
		echo "null";
	}
	
	
	echo ',';
	
	if(isset($_SESSION['current-chat']))// Agregue el isset pq es la forma q encontre de evitar el error q me tiraba en ajax('POST', 'ajax/checkNewMsgs.php', printUpdates, fromId, true);
	{
		if($mssg->getNewMessages($_SESSION['current-chat']))
			echo $mssg->getChat();
		elseif($mssg->getNewMessages($_SESSION['current-chat']) === false)
			echo $mssg->getErrors();
		else
			echo "null";
	}
	else
	{
		echo "null";
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