<?php

include_once "../../php/classes/BOUsers.php";
$u = new BOUsers;

//var_dump($_POST);

if(sizeof($_POST["vets"]) > 0 ){

for ($i=0; $i < sizeof($_POST["vets"]) ; $i++) { 
	
	$u->delete($_POST["vets"][$i]);
}


header("Location: ../vets.php?active=4&tab=delete");

}


?>
