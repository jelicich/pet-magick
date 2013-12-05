<?php 

session_start();

include('../php/classes/BOmessages.php');

$mssg = new BOmessages;

$data = array($_SESSION['id'], $_SESSION['datelog']);

$mssg->read($data);
echo $mssg->getMessages();

?>