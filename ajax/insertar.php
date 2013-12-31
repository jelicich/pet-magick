<?php

session_start();
include_once "../php/classes/BOPics.php";
$pics = new BOPics;

var_dump($_FILES);
if(isset($_FILES['file'])){
	$t = count($_FILES['file']['name']); // normalWay();
}else{
	$t = sizeof($_FILES); // fallback();
}

for($i = 0; $i < $t; $i++){

	$path = "../img";

	if(isset($_FILES['file'])){// normalWay();

		$file = $_FILES['file']['tmp_name'][$i];
		$fileName = $_FILES['file']['name'][$i];

	}else{// fallback();

		$file = $_FILES['file_'. $i]['tmp_name'];
		$fileName = $_FILES['file_'. $i]['name'];
	}

	$rand = rand(1000,9999);
	$ext = pathinfo($fileName, PATHINFO_EXTENSION);
	$newName = $rand . "_" . time() .'.' . $ext;  
	move_uploaded_file($file, $path.'/'.$newName);
	$path = $path.'/'.$newName;
	//$caption = $_POST['caption'];
	$caption = 'provisorio!!!!!!';

	$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));
}
		