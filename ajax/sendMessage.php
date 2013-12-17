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

// Modifico esto para q pueda handlear cuando hay usuario seleccionado o por default si esta dentro de la conversacion
if (empty($_POST['conversation'])){

	$to = $_SESSION['current-chat'];

}else{
	//HACER QUE $to sea el ID DE LA CONVERSACION ENTRE el usuario q seleccionó y $_SESSION(id)
	//$to
}

$data = array( 
	'to'=>$to,
	'message'=>$_POST['message']
	);


if($mssg->submit($data) != true)
	echo json_encode($mssg->err);
else
	echo $mssg->getMsgSent();



?>


