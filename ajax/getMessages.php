<?php 

session_start();

include_once('../php/classes/BOMessages.php');

$mssg = new BOMessages;

$data = $_SESSION['id'];
	
/**
 NO NECESITAMOS LA FECHA CREO
$data = array(
	'id'=>$_SESSION['id'], 
	'datelog'=>$_SESSION['datelog']
	);
*/

if($mssg->read($data))
	echo $mssg->getInbox();
else
	echo $mssg->getErrors();

?>