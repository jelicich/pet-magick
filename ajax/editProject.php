<?php

session_start();

/*
if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}

*/

include_once "../php/classes/BOProjects.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOAlbums.php";

$pro = new BOProjects;
$pics = new BOPics;
$a = new BOAlbums;

//var_dump($_GET); exit;

$query = array();
$id_last_insert;

function createQuery($query, $path, $class){

	$id_last_insert = $class->upload($query, $path);

}//create query


$albumId = $a->createAlbum();

$dato = array(

	'title' => $_POST['title'],
	'description'=> $_POST['description'],
	'project_id' => $_POST['pr'],
	'album_id' => $albumId

);



$pro->editProject($dato);
/*

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

*/

$_GET['u'] = $_SESSION['id']; // no se q onda esto....
include_once '../templates/adminProjects.php';


