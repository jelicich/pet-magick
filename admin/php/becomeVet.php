<?php

include_once "../../php/classes/BOUsers.php";
$u = new BOUsers;

//var_dump($_POST);exit;
$ref = array(
	'email'=> $_POST["email"],
	'rank'=> $_POST['yesOrNot']
	);
$u->becomeVet($ref);



header("Location: ../vets.php?active=4&tab=existing");




?>
