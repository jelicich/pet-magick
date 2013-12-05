<?php

session_start();

include('../php/classes/BOusers.php');
include('../php/classes/BOmessages.php');

$message = new BOMensaje;
$user = new BOUsuario;

if($_POST['rnd'] == '' || $_POST['rnd'] == null){ $id_dest['id'] = 'vacio'; }
else{$id_dest = $user->id_user($_POST['rnd']);}// REVISAR ESTO junto con el validar de BOMensaje////////////////////////////////////

$data = array(
	 $_SESSION['id_r'],
	 $id_dest['id'],
	 $_POST['mensaje']
);

if($mensaje->enviar($data) != true)
echo json_encode($mensaje->getErrores());






