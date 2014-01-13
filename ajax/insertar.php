<?php

session_start();
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";
include_once "../php/classes/BOUsers.php";

//var_dump($_POST); // PRUEBA PARA ELEMENTOS DE PERFIL (aca se ve el array y su contenido)

$pics = new BOPics;
$videos = new BOVideos;
$user = new BOUsers;

$query = array();
$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$flagVideo = false;
$id_last_insert;

function createQuery($query, $path, $class){

	$id_last_insert = $class->upload($query, $path);
	var_dump($id_last_insert);
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
		$query['caption']  = $_POST['caption'][$i];

		if( in_array($query['fileType'], $mimeVideo)){  
			
			$obj = $videos;
			$path = '../video/'; // Esto hay q hacerlo bien pq el path ya esta en la clase y este estaria quedando obsoleto....

		}else{

			$obj = $pics; 
			$path = '../img/users/';

		} // tratar de optimizar par ano repetir 
		
		createQuery($query, $path, $obj);
	}// end for
}else{ // fallBack();
	
	$counter = 0;
	foreach ($_FILES as $key => $eachFile) 
	{
				$captionpos = 'caption_'.$counter;
		
				
				$query['file'] = $eachFile['tmp_name'];
				$query['fileName'] = $eachFile['name'];
				$query['fileSize'] =$eachFile['size'];
				$query['fileType'] = $eachFile['type'];
				$query['caption'] = $_POST[$captionpos]; // RESOLVER!!!!!!!!!!!!!!!!!!!!

				if( in_array($query['fileType'], $mimeVideo)){  
				
					$obj = $videos;
					$path = '../img/videos/';

				}else{

					$obj = $pics; 
					$path = '../img/users/';

				} // tratar de optimizar par ano repetir 
		
		createQuery($query, $path, $obj);
		$counter++;
	}// end foreach
}// end else



//var_dump($_POST);
//le agrego a post la imagen;

$user->updateInfo($_POST);


