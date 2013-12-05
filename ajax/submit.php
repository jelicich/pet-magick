<?php

session_start();

include_once "../php/classes/BOusers.php";
include_once "../php/classes/BOmessages.php";

$mssg = new BOmessages;
$user = new BOUsers;

$to = $user->table->findByMail($_POST['to']);
$data = array($_POST['from'], $to[0]['ID_USER'],  $_POST['subject'],  $_POST['message']);


if($mssg->submit($data) != true)
echo json_encode($user->err);



?>


