<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if($_SESSION['id'] != $_POST['u']){

			include_once "../php/classes/BOFavorites.php";

			$ref = array('id_user_me' => $_SESSION['id'], 'id_user_favorite' =>$_POST['u']);

			$f = new BOFavorites;
			$f->addFavorite($ref);
	}
	

}else{

	echo "Request method error";
}


?>