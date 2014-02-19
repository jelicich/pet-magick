<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	include_once "../php/classes/BOFavorites.php";

	$f = new BOFavorites;
	$f->deleteFavorite($_POST['u']);
	
	include_once "../templates/favoritesModule.php";
	

}else{

	echo "Request method error";
}


?>