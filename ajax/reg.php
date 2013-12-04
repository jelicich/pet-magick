<?php

session_start();

include('../php/classes/BOusers.php');

$user = new BOusers;

$dato = array(
	$_POST['name'],
	$_POST['lastname'],
	$_POST['nickname'],

	$_POST['email'],
	$_POST['password'],
	$_POST['password2'],

	$_POST['rank'],
	$_POST['country'],
	$_POST['region'],
	$_POST['city'],
	$_POST['token'],
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
	include_once '../templates/userMenu.html';



}else{

	echo json_encode($user->err);
	
}
