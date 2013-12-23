<?php

session_start();
include_once "../php/classes/BOPics.php";
$pics = new BOPics;



$size = getimagesize($_FILES['file']['tmp_name']);
//$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
   var_dump($size);
	$path = "../img";
	$file = $_FILES['file']['tmp_name'];
	$fileName = $_FILES['file']['name'];// averiguar sobre esta funcion
	$rand = rand(1000,9999);
	$ext = pathinfo($fileName, PATHINFO_EXTENSION);
	$newName = $rand . "_" . time() .'.' . $ext;  
	move_uploaded_file($file, $path.'/'.$newName);
	$path = $path.'/'.$newName;
	//$caption = $_POST['caption'];
	$caption = 'provisorio!!!!!!';
    
	//$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));
	$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));