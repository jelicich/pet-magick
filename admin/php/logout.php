<?php

	session_start();
	include_once "../../php/classes/BOUsers.php";
	$u = new BOUsers;

	$u->logout($_SESSION['id']);
	session_destroy();

	header("Location: ../index.php");
	

?>