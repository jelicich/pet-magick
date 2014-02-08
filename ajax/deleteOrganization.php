<?php

session_start();
include_once "../php/classes/BOOrganizations.php";

$o = new BOOrganizations;
if(!$o->deleteOrganization($_POST['o']))
{
	echo $o->getErrors();
}


	
