<?php

session_start();
//var_dump($_POST['token']); exit;
include_once('../php/classes/BOUsers.php');
include_once '../blog/wp-load.php';

$u = new BOUsers;

//var_dump($_POST);
$dato = array(
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
	//'token' => $_POST['token']
);


if($u->registration($dato))
{
	$flag = 1;
	//include_once '../templates/logReg.php';
	echo json_encode(array('Registration successful!' => 'We have sent you an e-mail in order to confirm your account. Make sure to check your spam folder' ));
}
else
{
	echo json_encode($u->err);	
}
	











//if($u->registration($dato)){

			//echo "<div id='passAlert' class='alert alert-success'>Check your email and confirm your subscription</div>"; 
			//echo "<div id='passAlert' class='alert alert-danger'>There was a problem. Please try again in a few minutes</div>";
	
/*
				$user->login(array($_POST['email'],$_POST['password'], $_SESSION['token']));

				// busco el nombre de usuario
				$datosU = $user->table->findByMail($_POST['email']);

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

	*/
	//cargo el html con el menu del usuario
	/*if(isset($_POST['url']) && $_POST['url'] == 1)
	{
		include_once '../templates/userMenuBlog.php';
	}
	else
	{
		include_once '../templates/userMenu.php';
	}
	//cacheo la info para las herramientas de busqueda
	//include_once 'autoCompleteEverything.php';
*/
       // include_once 'autoCompleteEverything.php';
		//include_once '../templates/logReg.php';

//}else{

//	echo json_encode($u->err);
	
//}
