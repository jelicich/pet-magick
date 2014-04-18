<?php

session_start();
include_once "../php/classes/BOUsers.php";
$u = new BOUsers;

$u->logout($_SESSION['id']);


	include_once '../blog/wp-load.php';
	include_once '../blog/wp-admin/includes/user.php';
	wp_logout();
	wp_delete_user($_SESSION['id']); 

$u->deleteAllData($_SESSION['id']);
$rta = $u->deleteUser($_SESSION['id']);


session_destroy();


echo '<div id="modal-edit" class="edit-scrollable"><div class="mod-header"><h2>Delete Account</h2></div><div class="mod-content"><p>Your account has been deleted. We hope to see you again. <br/>You will be redirected to the home page.</p></div>';

//include_once '../templates/formlogin.php';
//header("Location: ../index.php");
	

?>