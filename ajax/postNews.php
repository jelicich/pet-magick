<?php

session_start();

include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BONews.php";

$news = new BONews;

	if(isset($_POST)){

		$query = array('news'=> $_POST['news'], 
					   'user_id'=> $_SESSION['id']
		);

		$news->insertNews($query);
		include_once "../templates/userNews.php";

		
	 }else{

		echo json_encode($news->getErrors());
	 }


?>