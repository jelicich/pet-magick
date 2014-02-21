<?php

session_start();
include_once "../php/classes/BOUsers.php";
$u = new BOUsers;
$u->logout($_SESSION['id']);


	include_once '../blog/wp-load.php';
	wp_logout();

session_destroy();



//include_once '../templates/formlogin.php';
header("Location: ../index.php");
	

?>