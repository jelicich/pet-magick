<?php

session_start();

include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BOMessages.php";

$mssg = new BOMessages;
$user = new BOUsers;
/**
Comento $to, hago las pruebas con el ID, dsps deberíamos poner un autocomplete ahi.
*/
//$to = $user->table->findByMail($_POST['to']); /**Hay una validacion q utiliza findbymail en BOMessages....
$data = array(
	'from'=>$_SESSION['id'], 
	'to'=>$_SESSION['current-chat'],
	'message'=>$_POST['message']
	);


if($mssg->submit($data) != true)
	echo json_encode($mssg->err);
else
	echo $mssg->getMsgSent();



?>


