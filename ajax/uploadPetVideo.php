<?php

session_start();


if(isset($_POST['p']))
	$idPet = $_POST['p'];
elseif(isset($_GET['p']))
	$idPet = $_GET['p'];


include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOVideos.php";

$pet = new BOPets;
$v = new BOVideos;

$query = array();
$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$flagVideo = false;
$id_last_insert;

function createQuery($query, $path, $class){

	if ($id_last_insert = $class->upload($query, $path))
	//le agrego a post la imagen;
		$_POST['pic']=$id_last_insert;
	else
		echo $class->getErrors();
}//create query


if(isset($_FILES['file'])){ // normalWay();
	
	$t = count($_FILES['file']['name']); 

	for($i = 0; $i < $t; $i++){

		$query['file'] = $_FILES['file']['tmp_name'][$i];
		$query['fileName'] = $_FILES['file']['name'][$i];
		$query['fileSize'] = $_FILES['file']['size'][$i];
		$query['fileType'] = $_FILES['file']['type'][$i];
		//$query['caption']  = $_POST['caption'][$i];
		$query['pet_id']  = $idPet;

		if( in_array($query['fileType'], $mimeVideo)){  
			
			$query['caption']  = $_POST['caption'];
			$query['title']  = $_POST['title'];

			$obj = $v;
			$path = '../video/'; 
			
			createQuery($query, $path, $obj);
		}else{		
			
			$path = '../img/pets/';
			createQuery($query, $path, $obj);
		} 
		
		
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
				$query['caption'] = $_POST["caption_".$p]; 

				if( in_array($query['fileType'], $mimeVideo)){  
					
					$query['caption']  = $_POST['caption'];
					$query['title']  = $_POST['title'];

					$obj = $videos;
					$path = '../img/videos/';

				}else{

					$obj = $pics; 
					$path = '../img/pets/';

				} 
		
		createQuery($query, $path, $obj);
		//$counter++;
	}// end foreach
}// end else


//$_GET['p'] = $idPet;
include_once "../templates/videoPosta.php";

