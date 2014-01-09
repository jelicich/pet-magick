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

function createQuery($query, $path, $class){

	$class->upload($query, $path);
	echo $class->getErrors();
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
			createQuery($query, '../img/videos/', $obj);
		}else{

			$obj = $pics; 
			createQuery($query, '../img/users/', $obj);

		} // tratar de optimizar par ano repetir 
		
		//createQuery($query, $path, $obj);
	}// end for
}else{ // fallBack();
	
	foreach ($_FILES as $key => $eachFile) {

		foreach ($_POST as $keyCaption => $eachCaption){
				
				$query['file'] = $eachFile['tmp_name'];
				$query['fileName'] = $eachFile['name'];
				$query['fileSize'] =$eachFile['size'];
				$query['fileType'] = $eachFile['type'];
				$query['caption'] = $eachCaption; // RESOLVER!!!!!!!!!!!!!!!!!!!!

				if( in_array($query['fileType'], $mimeVideo)){  
				
					$obj = $videos; 

				}else{

					$obj = $pics; 

				} // tratar de optimizar par ano repetir 
		}
		createQuery($query, $obj);
	}// end foreach
}// end else



//var_dump($_POST);
$user->updateInfo($_POST);


