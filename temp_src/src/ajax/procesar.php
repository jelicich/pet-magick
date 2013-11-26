<?php

session_start();

include_once "../BOUsuario.php";
include_once "../BOMensaje.php";

//guardo lo q viene por post y la fecha
$msg = new BOMensaje;
$u = new BOUsuario;

$d = array('id_from' =>$_SESSION['id'], 'dest' =>$_POST['to'], 'mensaje' =>$_POST['msg'] );
if(!$msg->enviar($d))
	echo json_encode($msg->getErrores());
	

/*
$json=$_POST;
$json['fecha']=date("Y-m-d H:i:s");

//formateo lo q manda
$json=json_encode($json);

//la ruta donde se va a guardar
$ruta = $_POST['desti'].'.txt';

 
//guardo todo
$r = file_put_contents($ruta, $json.",", FILE_APPEND | LOCK_EX);

var_dump($r);
 */
?>
