<?php

session_start();

include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BOMessages.php";
include_once "../php/classes/BOConversations.php";

$mssg = new BOMessages;
$user = new BOUsers;
$conv = new BOConversations;



if (!isset($_POST['recipient']))
{
	$to = $_SESSION['current-chat'];
}
elseif($_POST['recipient'] == '')
{
	echo "Please, select a recipient";
	die;	
}
elseif($_POST['recipient'] == $_SESSION['id'])
{
	echo "You can't send a message to yourself";
	die;
}
else
{
	if($conv->existsConversation($_POST['recipient']))
	{
		$to = $conv->getConversationId();
	}
	else
	{
		$conv->createConversation($_POST['recipient']);
		$to = $conv->getConversationId();	
	}

	unset($_SESSION['current-chat']);
}


$message_clean = htmlspecialchars($_POST['message']);

$data = array( 
	'conversation'=>$to,
	'message'=> $message_clean 
	);


if($mssg->submit($data) != true)
	echo json_encode($mssg->err);
else
	echo $mssg->getMsgSent();



?>


