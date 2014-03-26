<?php

//var_dump($_POST); exit;
session_start();
include_once "../php/classes/BOUsers.php";

$u = new BOUsers;

$data = $_POST['user_email'];

$info = $u->forgotPassword($data);



//WP user
include_once '../blog/wp-load.php';
//wp_set_password($_POST['password'],$_POST['user_id']);
wp_update_user($info);

?>