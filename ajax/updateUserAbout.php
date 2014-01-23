<?php

session_start();


if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}


include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";
include_once "../php/classes/BOUsers.php";



$pics = new BOPics;
$videos = new BOVideos;
$user = new BOUsers;
//var_dump($_POST);

$query = array();
$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$flagVideo = false;
$id_last_insert;

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

		if( in_array($query['fileType'], $mimeVideo)){  

			$query['caption']  = $_POST['caption'];
			$query['title']  = $_POST['title'];
			
			$obj = $videos;
			$path = '../video/'; 

		}else{

			$query['caption']  = $_POST['caption'][$i];
				
			$obj = $pics; 
			$path = '../img/users/';

		} 
		
		createQuery($query, $path, $obj);
	}// end for
}else{ // fallBack();
	

	foreach ($_FILES as $key => $eachFile) 
	{
				$index = strpos($key, "_");
		  		$index++;
		  		$p = substr($key, $index);

				$query['file'] = $eachFile['tmp_name'];
				$query['fileName'] = $eachFile['name'];
				$query['fileSize'] =$eachFile['size'];
				$query['fileType'] = $eachFile['type'];
				$query['caption'] = $_POST["caption_".$p]; // LISTO!!!!!!!!!!!!!!!!!!!!

				if( in_array($query['fileType'], $mimeVideo)){  
					$query['title'] = $_POST["title"]; // LISTO!!!!!!!!!!!!!!!!!!!!
					$obj = $videos;
					$path = '../img/videos/';

				}else{

					$obj = $pics; 
					$path = '../img/users/';

				} 
		
		createQuery($query, $path, $obj);
		//$counter++;
	}// end foreach
}// end else

$user->updateInfo($_POST,'../img/users/');

$_GET['u'] = $_SESSION['id']; //imprimo esto para poder tener un response.text con el id del usuario y que deje de tirar el error de la variable U
include_once "../templates/userAbout.php";

