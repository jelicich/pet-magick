<?php

session_start();

include_once('../php/classes/BOUsers.php');

$user = new BOUsers;

$dato = array(
	'name' => $_POST['name'],
	'lastname' => $_POST['lastname'],
	'nickname' => $_POST['nickname'],

	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'password2' => $_POST['password2'],

	'country' => $_POST['country'],
	'region' => $_POST['region'],
	
	'city' => $_POST['city'],
	'token' => $_POST['token']
);



if($user->registration($dato)){// Tal vez no haga falta repetir este if. Es la misma de login.php
	
	$user->login(array($_POST['email'],$_POST['password'], $_SESSION['token']));

	// busco el nombre de usuario
	$datosU = $user->table->findByMail($_POST['email']);

	//guardo en sesion datos q pueda llegar a necesitar
	$_SESSION['id'] = $datosU[0]['ID_USER'];
	$_SESSION['datelog'] = date('Y-m-d H:i:s');
	$_SESSION['name'] = $datosU[0]['NAME'];
	$_SESSION['lastname'] = $datosU[0]['LASTNAME'];
	$_SESSION['nickname'] = $datosU[0]['NICKNAME'];
	$_SESSION['email'] = $datosU[0]['EMAIL'];

	//cargo el html con el menu del usuario
	include_once '../templates/userMenu.php';



}else{

	echo json_encode($user->err);
	
}
