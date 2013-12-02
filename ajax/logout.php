<?php

session_start();
include_once "../php/classes/BOusers.php";
$u = new BOusers;

$u->logout($_SESSION['id']);
session_destroy();

//include_once '../templates/formlogin.php';
//header("Location: ../index.php");
	

?>