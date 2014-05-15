<?php

session_start();

/*
if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}

*/

//var_dump($_POST); exit;

include_once "../php/classes/BOOrganizations.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOAlbums.php";

$org = new BOOrganizations;
$pics = new BOPics;
$a = new BOAlbums;

//var_dump($_POST); exit;
if(isset($_POST['delete-pic'])){
	$deletePic = $_POST['delete-pic'];
}else{
	$deletePic = 0;
}

$query = array();
$id_last_insert;

function createQuery($query, $path, $class){

	$id_last_insert = $class->upload($query, $path);

}//create query


//$albumId = $a->createAlbum();

$newData = array(

	'title' => $_POST['title'],
	'description'=> $_POST['description'],
	'organization_id' => $_POST['org']
	//'album_id' => $_POST['albumId']

);



$org->editOrganization($newData, $deletePic, "../img/organizations/");


if(isset($_FILES['file'])){ // normalWay();

	$t = count($_FILES['file']['name']); 

	for($i = 0; $i < $t; $i++){

		$query['file'] = $_FILES['file']['tmp_name'][$i];
		$query['fileName'] = $_FILES['file']['name'][$i];
		$query['fileSize'] = $_FILES['file']['size'][$i];
		$query['fileType'] = $_FILES['file']['type'][$i];
		$query['caption']  = $_POST['caption'][$i];

		$path = '../img/organizations/';
		$pics->upload($query,$path,$_POST['albumId']);

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
		$path = '../img/organizations/';

		createQuery($query, $path, $obj);

	}// end foreach
}// end else



$_GET['u'] = $_SESSION['id']; // no se q onda esto....
include_once '../templates/adminOrganizations.php';


