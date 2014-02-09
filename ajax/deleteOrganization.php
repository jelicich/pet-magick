<?php

session_start();
include_once "../php/classes/BOOrganizations.php";

$org = new BOOrganizations;
if(!$org->deleteOrganization($_POST['o']))
{
	echo $org->getErrors();
}


$_POST['u'] = $_SESSION['id'];
include_once "../templates/adminOrganizations.php";

	
