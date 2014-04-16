<?php

session_start();
include_once "../php/classes/BOUsers.php";
$u = new BOUsers;

$u->logout($_SESSION['id']);


	include_once '../blog/wp-load.php';
	include_once '../blog/wp-admin/includes/user.php';
	wp_logout();
	wp_delete_user($_SESSION['id']); 

$rta = $u->deleteUser($_SESSION['id']);

var_dump($rta);

die;
session_destroy();



//include_once '../templates/formlogin.php';
header("Location: ../index.php");
	

?>