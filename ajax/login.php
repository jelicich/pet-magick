<?php

session_start();
include_once "../php/classes/BOUsers.php";
$user = new BOUsers;

//if($user->login(array($_POST['email'],$_POST['password'], $_POST['token']))) //si devuelve true
if($user->login(array($_POST['email'],$_POST['password'], $_SESSION['token']))) // Fijate q tuve q cambiar esto para q imprimiera un sha, pero no se bien q onda.
{
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
}
else 
{
	echo json_encode($user->err);
	/*
	foreach ($er as $key => $value) 
	{
		echo '<p>Err# <strong>' . $key . '</strong>: '. $value . '</p>';	
	}
	*/
}
?>