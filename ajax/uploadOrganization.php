<?php

session_start();
include_once "../php/classes/BOOrganizations.php";
include_once "../php/classes/BOPics.php";

$org = new BOOrganizations;
$pics = new BOPics;


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
		$path = '../img/organizations/';

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
				$path = '../img/organizations/';
		
				createQuery($query, $path, $obj);$counter++;
	}// end foreach
}// end else


$dato = array(

	'name' => $_POST['name'],
	'description' => $_POST['description'],
	'user_id' => $_SESSION['id'],
	'pic_id' => $_POST['pic']
);

var_dump($_POST);
$org->insertOrganizations($dato);




?>