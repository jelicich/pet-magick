<?php

session_start();

include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BOMessages.php";
include_once "../php/classes/BOConversations.php";

$mssg = new BOMessages;
$user = new BOUsers;
$conv = new BOConversations;
/**
Comento $to, hago las pruebas con el ID, dsps deberíamos poner un autocomplete ahi.
*/
//$to = $user->table->findByMail($_POST['to']); /**Hay una validacion q utiliza findbymail en BOMessages....

// Modifico esto para q pueda handlear cuando hay usuario seleccionado o por default si esta dentro de la conversacion
if (!isset($_POST['recipient']) || empty($_POST['recipient']))
{
	$to = $_SESSION['current-chat'];

}else{
	//HACER QUE $to sea el ID DE LA CONVERSACION ENTRE el usuario q seleccionó y $_SESSION(id)
	//$to
	if($conv->existsConversation($_POST['recipient']))
	{
		$to = $conv->getConversationId();
	}
	else
	{
		$conv->createConversation($_POST['recipient']);
		$to = $conv->getConversationId();	
	}

	$_SESSION['current-chat'] = $to;
}

$data = array( 
	'conversation'=>$to,
	'message'=>$_POST['message']
	);


if($mssg->submit($data) != true)
	echo json_encode($mssg->err);
else
	echo $mssg->getMsgSent();



?>


