<?php

session_start();
include_once "../php/classes/BOUsers.php";
$user = new BOUsers;

if($user->autoComplete($_POST['user']))
	echo $user->getComplete();
	

/*
	$dato = array(
	'user' => $_POST['user'],
	'inputLength' => $_POST['inputLength'],
);
*/