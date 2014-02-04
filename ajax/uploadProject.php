<?php



/*

if(!isset($_POST['p']) || $_POST['owner'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}*/


session_start();

include_once "../php/classes/BOProjects.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOAlbums.php";

$project = new BOProjects;
$pics = new BOPics;
$a = new BOAlbums;

//var_dump($_POST);

$query = array();
$id_last_insert;

function createQuery($query, $path, $class){

	$id_last_insert = $class->upload($query, $path);
	//var_dump($id_last_insert);
	//le agrego a post la imagen;
	//$_POST['pic'] = $id_last_insert;
	//echo $class->getErrors();
}//create query


	//busco si tiene album
/*	$albumId = $project->getAlbumIdByProject($_POST['p']);
	//si no tiene creo uno
	if(empty($albumId))
	{
		$a = new BOAlbums;
		$id = $a->createAlbum();
		//setAlbum(ALBUM-ID , ID-PET)
		$project->setAlbum($id, $_POST['p']);
		$albumId = $id;
	}
*/
		

		



$albumId = $a->createAlbum();

$dato = array(

	'title' => $_POST['title'],
	'description'=> $_POST['description'],
	'user_id' => $_SESSION['id'],
	'album_id' => $albumId

);

$project->insertProjects($dato);

if(isset($_FILES['file'])){ // normalWay();

	$t = count($_FILES['file']['name']); 

	for($i = 0; $i < $t; $i++){

		$query['file'] = $_FILES['file']['tmp_name'][$i];
		$query['fileName'] = $_FILES['file']['name'][$i];
		$query['fileSize'] = $_FILES['file']['size'][$i];
		$query['fileType'] = $_FILES['file']['type'][$i];
		$query['caption']  = $_POST['caption'][$i];

		$path = '../img/projects/';
		$pics->upload($query,$path,$albumId);

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

		$obj = $pics; 
		$path = '../img/projects/';

		createQuery($query, $path, $obj);

	}// end foreach
}// end else



//var_dump($_POST);


//$pet->updateAlbum($_POST,'../img/pets/');

//$_GET['p'] = $_SESSION['id'];
//include_once "../templates/petAlbum.php";

