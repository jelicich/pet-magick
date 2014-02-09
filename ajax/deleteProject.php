<?php

session_start();
include_once "../php/classes/BOProjects.php";

$pro = new BOProjects;
if(!$pro->deleteProject($_POST['pr']))
{
	echo $pro->getErrors();
}


$_POST['u'] = $_SESSION['id'];
include_once "../templates/adminProjects.php";

	
