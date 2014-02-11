<?php


session_start();
include_once "../php/classes/BOVettalk.php";

$vt = new BOVettalk;
if(!$vt->deleteVetTalk($_POST['o']))
{
	echo $vt->getErrors();
}


$_POST['u'] = $_SESSION['id'];
include_once "../templates/adminVettalk.php";

	
