<?php

session_start();
include_once "../php/classes/BOVettalk.php";
include_once "../php/classes/BOPics.php";

$vt = new BOVettalk;
$pics = new BOPics;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
	{
		echo 'Session ERROR';
		die;
	}

	function createQuery($query, $path, $class){

		$id_last_insert = $class->upload($query, $path);
		//var_dump($id_last_insert);
		//le agrego a post la imagen;
		$_POST['pic']=$id_last_insert;
		//echo $class->getErrors();
	}//create query

	if(isset($_FILES['file'])){ // normalWay();

		$t = count($_FILES['file']['name']); 

		for($i = 0; $i < $t; $i++){

			$query['file'] = $_FILES['file']['tmp_name'][$i];
			$query['fileName'] = $_FILES['file']['name'][$i];
			$query['fileSize'] = $_FILES['file']['size'][$i];
			$query['fileType'] = $_FILES['file']['type'][$i];
			$query['caption']  = '';

			$obj = $pics; 
			$path = '../img/vetTalk/';

			createQuery($query, $path, $obj);

		}// end for
	}else{ // fallBack();
		
		foreach ($_FILES as $key => $eachFile) 
		{
					//$index = strpos($key, "_");
			  		//$index++;
			  		//$p = substr($key, $index);

					$query['file'] = $eachFile['tmp_name'];
					$query['fileName'] = $eachFile['name'];
					$query['fileSize'] =$eachFile['size'];
					$query['fileType'] = $eachFile['type'];
					$query['caption'] = ''; 

					$obj = $pics; 
					$path = '../img/vetTalk/';
			
					createQuery($query, $path, $obj);$counter++;
		}// end foreach
	}// end else

	if(!isset($_POST['pic'])){ $_POST['pic'] = null; }
	
	$query = array(

		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'user_id' => $_POST['u'],
		'pic_id' => $_POST['pic'],
		'category' => $_POST['category']
	);

	//var_dump($_POST);
	if(!$vt->insertArticle($query))
		echo $vt->getErrors();



	include_once '../templates/adminVettalk.php';
	

}	
	?>