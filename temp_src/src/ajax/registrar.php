<?php

include_once "../BOUsuario.php";

$u = new BOUsuario;
if($u->registrar($_POST))
{
	include '../templates/formlogin.php';
}
else
{
	$e = $u->getErrores();
	echo json_encode($e);
}



?>