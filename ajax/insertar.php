<?php

session_start();
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";
$pics = new BOPics;
$videos = new BOVideos;

var_dump($_POST);
//PUTOOOO FORM DATA
/*
Post no lo manda normal, lo manda con una sola posición y toda esta basura adentro q no se q es. no pude manejarlo, me ganó.

array(1) {
  ["------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition:_form-data;_name"]=>
  string(645) ""name"

esteban
------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="lastname"

jelicich
------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="nickname"

esteban
------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="country"

Country
------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="region"


------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="city"


------WebKitFormBoundary7Ke69n0I2FWxAV9I
Content-Disposition: form-data; name="about"


------WebKitFormBoundary7Ke69n0I2FWxAV9I--
"
}

*/

//var_dump($_FILES);

/*

$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$flagVideo = false;


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
			//$caption = $_POST['caption'][$i];
			if( in_array($_FILES['file']['type'][$i], $mimeVideo)){  $flagVideo = true; } // modificar


		}else{// fallBack();

			$file = $_FILES['file_'. $i]['tmp_name'];
			$fileName = $_FILES['file_'. $i]['name'];
			$fileSize = $_FILES['file_'. $i]['size'];
			$fileType = $_FILES['file_'. $i]['type'];
			//$caption = $_POST['caption_'. $i];
			if( in_array($_FILES['file_'. $i]['type'], $mimeVideo)){ $flagVideo = true; } // modificar
		}

		$query = array( 'file'=>$file, 
						'fileName'=>$fileName, 
						'fileSize'=>$fileSize, 
						'fileType'=>$fileType 
						//'caption'=> $caption
		);

		if($flagVideo == true){ // modificar

			$videos->upload_video($query);
			echo $videos->getErrors();

		}else{
			//echo $fileName = $_FILES['file']['name'][$i].'<br>';
		    $pics->upload_img($query);
		    echo $pics->getErrors();

		}//end else
}//end for
*/