<?php

session_start();

include_once "../BOUsuario.php";
include_once "../BOMensaje.php";

$m = new BOMensaje;

$d = array('id' => $_SESSION['id'], 'fecha'=>$_SESSION['fechalog']);

$m->leer($d);
$msgs = $m->getLeido();

echo $msgs;
/*

if(isset($_GET['usuario']))
{
	$archivo = $_GET['usuario'].'.txt';
	
	if(file_exists($archivo))
	{
		$json = file_get_contents($archivo);
		$json = trim($json, ",");
		echo '['.$json.']';
		unlink($archivo);
	}
	else
	{
		echo '[]';
	}
}

*/
?>
