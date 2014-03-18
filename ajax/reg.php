<?php

session_start();

include_once('../php/classes/BOUsers.php');

$user = new BOUsers;


//reg wordpress
	include_once '../blog/wp-load.php';

	$user_name = $_POST['nickname'];
	$user_email = $_POST['email'];
	$user_password = $_POST['password'];

	$user_id = username_exists( $user_name );
	if ( !$user_id ) 
	{
		$user_id = wp_create_user( $user_name, $user_password, $user_email );
	} 
// END wp

//var_dump($_POST);
$dato = array(
	'id' => $user_id,
	'name' => $_POST['name'],
	'lastname' => $_POST['lastname'],
	'nickname' => $_POST['nickname'],

	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'password2' => $_POST['password2'],

	'country' => $_POST['country'],
	'region' => $_POST['region'],
	
	'city' => $_POST['city'],
	'rank' => 0,
	'token' => $_POST['token']
);


if($user->registration($dato)){// Tal vez no haga falta repetir este if. Es la misma de login.php
	
	$user->login(array($_POST['email'],$_POST['password'], $_SESSION['token']));

	// busco el nombre de usuario
	$datosU = $user->table->findByMail($_POST['email']);
//var_dump($datosU);
	//guardo en sesion datos q pueda llegar a necesitar
	$_SESSION['id'] = $datosU[0]['ID_USER'];
	$_SESSION['datelog'] = date('Y-m-d H:i:s');
	$_SESSION['name'] = $datosU[0]['NAME'];
	$_SESSION['lastname'] = $datosU[0]['LASTNAME'];
	$_SESSION['nickname'] = $datosU[0]['NICKNAME'];
	$_SESSION['email'] = $datosU[0]['EMAIL'];

	
	
	
	//ACA HAY Q MODIFICARLO YA QUE CUANDO SE REGISTRA TIENE QUE CONFIRMAR POR MAIL POR LO TANTO NO SE PUEDE LOGUEAR DE UNA
	//ACA HAY Q MODIFICARLO YA QUE CUANDO SE REGISTRA TIENE QUE CONFIRMAR POR MAIL POR LO TANTO NO SE PUEDE LOGUEAR DE UNA
	//ACA HAY Q MODIFICARLO YA QUE CUANDO SE REGISTRA TIENE QUE CONFIRMAR POR MAIL POR LO TANTO NO SE PUEDE LOGUEAR DE UNA
	//ACA HAY Q MODIFICARLO YA QUE CUANDO SE REGISTRA TIENE QUE CONFIRMAR POR MAIL POR LO TANTO NO SE PUEDE LOGUEAR DE UNA

	
	//cargo el html con el menu del usuario
	if(isset($_POST['url']) && $_POST['url'] == 1)
	{
		include_once '../templates/userMenuBlog.php';
	}
	else
	{
		include_once '../templates/userMenu.php';
	}
	//cacheo la info para las herramientas de busqueda
	include_once 'autocompleteEverything.php';

}else{

	echo json_encode($user->err);
	
}
