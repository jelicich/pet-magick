<?php

session_start();
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";
$pics = new BOPics;
$videos = new BOVideos;

var_dump($_POST['caption']);
$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$flagProvisorio = 0;

if(isset($_FILES['file'])){

	$t = count($_FILES['file']['name']); // normalWay();
}else{

	$t = sizeof($_FILES); // fallback();
}

for($i = 0; $i < $t; $i++){

		if(isset($_FILES['file'])){// normalWay();
		
			$file = $_FILES['file']['tmp_name'][$i];
			$fileName = $_FILES['file']['name'][$i];
			$fileSize = $_FILES['file']['size'][$i];
			$fileType = $_FILES['file']['type'][$i];
			$caption = $_POST['caption'][$i];
			if( in_array($_FILES['file']['type'][$i], $mimeVideo)){  $flagProvisorio = 1; } // modificar


		}else{// fallBack();

			$file = $_FILES['file_'. $i]['tmp_name'];
			$fileName = $_FILES['file_'. $i]['name'];
			$fileSize = $_FILES['file_'. $i]['size'];
			$fileType = $_FILES['file_'. $i]['type'];
			$caption = $_POST['caption_'. $i];
			if( in_array($_FILES['file_'. $i]['type'], $mimeVideo)){ $flagProvisorio = 1; } // modificar
		}

		$query = array( 'file'=>$file, 
						'fileName'=>$fileName, 
						'fileSize'=>$fileSize, 
						'fileType'=>$fileType, 
						'caption'=> $caption);

		if($flagProvisorio == 1){ // modificar

			$videos->upload_video($query);
			echo $videos->getErrors();

		}else{

		    $pics->upload_img($query);
		    echo $pics->getErrors();

		}//end else
}//end for