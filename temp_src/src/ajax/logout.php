<?php

session_start();
include_once "../BOUsuario.php";
$u = new BOUsuario;

$u->logout($_SESSION['id']);
session_destroy();

include_once '../templates/formlogin.php';
	

?>