<?php

session_start();
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";
$pics = new BOPics;
$videos = new BOVideos;

//$mimeImg = array('image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
$mimeVideo = array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
$mime = array('image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 
			  'video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');
/*$mime = array('img' => array('image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 
			  'video' => array('video/mp3', 'video/mp4', 'video/ogg', 'video/webm','video/wav');*/

//================================================= VALIDATIONS

if(isset($_FILES['file'])){
	$t = count($_FILES['file']['name']); // normalWay();
}else{
	$t = sizeof($_FILES); // fallback();
}

$flagProvisorio = 0;

for($i = 0; $i < $t; $i++){

	if(isset($_FILES['file'])){// normalWay();

			if($_FILES['file']['size'][$i] > 90000000000000000) 
			{// ver q medidas necesito aca para cada formato, tal vez separarlos
				echo '<span>muy grande desde php</span>';
				return;
			}
			if(!in_array($_FILES['file']['type'][$i], $mime)){
				// ver si esto lo junto  o lo evaluo separado
				echo '<span>formato invalido desde php</span>';
				return;
			}

			$file = $_FILES['file']['tmp_name'][$i];
			$fileName = $_FILES['file']['name'][$i];
			if(in_array($_FILES['file']['type'][$i], $mimeVideo)){  $flagProvisorio = 1; } // modificar


	}else{// fallback();

			//var_dump($_FILES);
			if($_FILES['file_'. $i]['size'] > 90000000000) 
			{
				echo '<span>muy grande desde php</span>';
				return;
			}
			if(!in_array($_FILES['file_'. $i]['type'], $mime )){
				
				echo '<span>formato invalido desde php</span>';
				return;
			}

			$file = $_FILES['file_'. $i]['tmp_name'];
			$fileName = $_FILES['file_'. $i]['name'];
			if( in_array($_FILES['file_'. $i]['type'], $mimeVideo)){ $flagProvisorio = 1; } // modificar
	}

//================================================= SHOW IMG & BD

	
		
		
		if($flagProvisorio == 1 || $flagProvisorio == 2){ // modificar

		extension_loaded('ffmpeg') or die('Error in loading ffmpeg');
		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		$rand = rand(1000,9999);
		$path = "../video";
		$newName = $rand . "_" . time() .'.' . $ext; 
		$thumbName =  $rand . "_" . time() .'.jpg';
		move_uploaded_file($file, $path.'/'.$newName);
		$path = realpath($path.'/'.$newName); // averiguar bien q hace esta funcion
		$thumbPath = '../video/thumb/'.$thumbName;
		
		function getThumbImage($route, $thumbRoute){ // ver pq se ejecuta antes de instanciarla esta puta function

			$movie = new ffmpeg_movie($route,false);
			$videoDuration = $movie->getDuration();
			$frameCount = $movie->getFrameCount();
			$frameRate = $movie->getFrameRate();
			$videoTitle = $movie->getTitle();
			$author = $movie->getAuthor() ;
			$copyright = $movie->getCopyright();
			$frameHeight = $movie->getFrameHeight();
			$frameWidth = $movie->getFrameWidth();

			$capPos = ceil($frameCount/4);

			if($frameWidth>120)
			{
				$cropWidth = ceil(($frameWidth-120)/2);
			}
			else
			{
				$cropWidth =0;
			}
			if($frameHeight>90)
			{
				$cropHeight = ceil(($frameHeight-90)/2);
			}
			else
			{
				$cropHeight = 0;
			}
			if($cropWidth%2!=0)
			{
				$cropWidth = $cropWidth-1;
			}
			if($cropHeight%2!=0)
			{
				$cropHeight = $cropHeight-1;
			}

				$frameObject = $movie->getFrame($capPos);


			if($frameObject)
			{
				$imageName = $thumbRoute;
				$tmbPath = $imageName;
				$frameObject->resize(120,90,0,0,0,0);
				imagejpeg($frameObject->toGDImage(),$tmbPath);
			}
			else
			{
				$imageName="";
			}
			return $imageName;
		}

		getThumbImage($path, $thumbPath);
		$caption = 'provisorio!!!!!!';
		//$videos->upload_video(array('video'=>$path, /*'thumb'=>$path2,*/ 'caption'=>$caption));


	}else{

		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		$rand = rand(1000,9999);
		$path = "../img";
		
		$newName = $rand . "_" . time() .'.' . $ext;  
		move_uploaded_file($file, $path.'/'.$newName);
		$path = $path.'/'.$newName;
		$path2= "img/thumb".$newName; //para thumb
		//$caption = $_POST['caption'];
		$caption = 'provisorio!!!!!!';

		$imgOriginal = "../img/". $newName ;

		//creo una nueva foto a partir de la anterior
		$img_original = imagecreatefromjpeg( $imgOriginal ) ;
		// maximo ancho y alto
		$max_ancho = 220;
		$max_alto = 2000;

		// separo alto y ancho de la imgOriginal en dos variables
		list( $anchoImgOriginal, $altoImgOriginal ) = getimagesize( $imgOriginal ) ;

		$x_ratio = $max_ancho / $anchoImgOriginal ;
		$y_ratio = $max_alto / $altoImgOriginal ;

		if( $anchoImgOriginal <= $max_ancho){
			$anchoFinal = $anchoImgOriginal ;
			$altoFinal = $altoImgOriginal ;
		}
		elseif( $anchoImgOriginal > $max_ancho ){
			$altoFinal = ceil( $x_ratio * $altoImgOriginal ) ;
			$anchoFinal = $max_ancho ; 
		} elseif( $altoImgOriginal > $max_alto ){
			$anchoFinal = ceil( $y_ratio * $anchoImgOriginal ) ;
			$altoFinal = $max_alto ; 
		}

		$imgNueva = imagecreatetruecolor( $anchoFinal, $altoFinal ) ;
		//ACA HABRIA Q VER COMO CROPEAR debe ser una gilada
		imagecopyresampled( $imgNueva, $img_original, 0, 0, 0, 0, $anchoFinal, $altoFinal, $anchoImgOriginal, $altoImgOriginal );

		//imagedestroy( $img_original );

		$calidad = 100 ;

		imagejpeg( $imgNueva, '../img/thumb/' . $newName, $calidad ) ;

		$pics->upload_img(array('pic'=>$path, /*'thumb'=>$path2,*/ 'caption'=>$caption));
		}
}
