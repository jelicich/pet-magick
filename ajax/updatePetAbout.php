<?php

session_start();




if(!isset($_POST['p']) || $_POST['owner'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}

include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";



$pet = new BOPets;
$pics = new BOPics;
$videos = new BOVideos;
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
		$query['caption']  = '';

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
		$counter++;
	}// end foreach
}// end else



//var_dump($_POST);


/*
$pet->updateInfo($_POST,'../img/pets/');


include_once "../templates/petAbout.php";
*/


if( $pet->updateInfo($_POST,'../img/pets/') )
{
	include_once "../templates/petAbout.php";

}
else
{
	include_once "../php/classes/BOAnimalCategories.php";
	$ac = new BOAnimalCategories;
	$_GET['p'] = $_POST['p'];
	echo $pet->getErr();
	$p = new BOPets;
	

	include_once "../templates/editPetAbout.php";
}


//create tribute
if(isset($_POST['create-tribute']))
{
	include_once '../php/classes/BOTributes.php';
	$t = new BOTributes;
	$_POST['u'] = $_POST['owner'];

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
//delete tribute
elseif(isset($_POST['delete-tribute']))
{
	//var_dump($_POST);
	if($_POST['tr-user'] != $_SESSION['id'])
	{
		echo "There was a problem with your session";
		die;
	}
	else
	{
		include_once '../php/classes/BOTributes.php';
		$t = new BOTributes;
		$t->deleteTribute($_POST['delete-tribute']);
	}
}
//edit tribute
elseif(isset($_POST['tr-id']))
{
	if($_POST['tr-user'] != $_SESSION['id'])
	{
		echo "There was a problem with your session";
		die;
	}
	else
	{
		include_once '../php/classes/BOTributes.php';
		$t = new BOTributes;
		if(!$t->updateTribute($_POST))
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
