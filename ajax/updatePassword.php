<?php

//var_dump($_POST); exit;
session_start();
include_once "../php/classes/BOUsers.php";

$u = new BOUsers;

$data = array(

	'user_id' => $_POST['user_id'],
	'password'=> $_POST['password'],
	'newPassword' => $_POST['newPassword']
);

$u->updatePassword($data);

//WP user
include_once '../blog/wp-load.php';
//wp_set_password($_POST['password'],$_POST['user_id']);
wp_update_user(array('ID' => $_POST['user_id'], 'user_pass' => $_POST['newPassword']));

?>