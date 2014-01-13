<?php

session_start();
include_once "../php/classes/BONews.php";
$news = new BONews;

	if(isset($_POST)){

		$query = array('news'=> $_POST['news'], 
					   'user_id'=> $_SESSION['id']
		);

		$news->insertNews($query);
		
	 }else{

		echo json_encode($news->getErrors());
	 }


?>