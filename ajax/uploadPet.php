<?php

session_start();

//var_dump($_POST);

if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}

include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";





$p = new BOPets;
$pics = new BOPics;
$videos = new BOVideos;




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
		$query['caption']  = $_POST['caption'][$i];

		if( in_array($query['fileType'], $mimeVideo)){  
			
			$obj = $videos;
			$path = '../video/'; 

		}else{

			$obj = $pics; 
			$path = '../img/pets/';

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
				$query['caption'] = $_POST["caption_".$p]; 

				if( in_array($query['fileType'], $mimeVideo)){  
				
					$obj = $videos;
					$path = '../img/videos/';

				}else{

					$obj = $pics; 
					$path = '../img/pets/';

				} 
		
		createQuery($query, $path, $obj);
		$counter++; //esta variable creo q esta de mas 
	}// end foreach
}// end else



//var_dump($_POST);


$idPet = $p->addPet($_POST);
if(!$idPet)
{
	include_once "../php/classes/BOAnimalCategories.php";
	$ac = new BOAnimalCategories;
	$err = $p->getErr();
	echo '<p>Error creating new pet</p><ul class="error upload-pet">';
	for($i=0; $i < sizeof($err); $i++)
	{
		echo '<li>'.$err[$i].'</li>';
	}
	echo '</ul>';
	$_GET['u'] = $_POST['u'];
	include_once "../templates/addPet.php";
	
}
else
{
	$p->getPetData($idPet);


	include_once "../templates/petProfile.php";	

	if(isset($_POST['create-tribute']))
	{
		include_once '../php/classes/BOTributes.php';
		$t = new BOTributes;
		$_POST['p'] = $idPet;
		$idTr = $t->createTribute($_POST);
		if(!$idTr)
		{
			$err = $t->getErr();
			echo '<p>Error creating the tribute</p><ul class="error upload-tribute">';
			for($i=0; $i < sizeof($err); $i++)
			{
				echo '<li>'.$err[$i].'</li>';
			}
			echo '</ul>';
		}
	}


}









