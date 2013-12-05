<?php 

session_start();

include('../php/classes/BOmessages.php');

$message = new BOmessages;

$data = array(
	$_SESSION['id_r'],
	$_SESSION['fecha']
);

$message->read($data);
echo $message->getMessages();

?>