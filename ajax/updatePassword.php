<?php

//var_dump($_POST); exit;
session_start();
include_once "../php/classes/BOUsers.php";

$u = new BOUsers;

$data = array(

	'user_id' => $_POST['user_id'],
	'password'=> $_POST['password'],
	'newPassword' => $_POST['newPassword']
);

$u->updatePassword($data);


?>