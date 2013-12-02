<?php

session_start();
include_once "../BOUsuario.php";
$u = new BOUsuario;

if($u->login($_POST['usuario'],$_POST['password'], $_POST['token']))
{
	// busco el nombre de usuario
	$datosU = $u->tabla->buscarPorMail($_POST['usuario']);
	
	$_SESSION['id'] = $datosU[0]['ID'];
	$_SESSION['fechalog'] = date('Y-m-d H:i:s');
	$_SESSION['nombre'] = $datosU[0]['NOMBRE'];
	//$datosU= $datosU->toArray();
	include_once '../templates/formchat.php';
}
else
{
	$er = $u->getErrores();
	echo json_encode($er);
	/*
	foreach ($er as $key => $value) 
	{
		echo '<p>Err# <strong>' . $key . '</strong>: '. $value . '</p>';	
	}
	*/
}
?>