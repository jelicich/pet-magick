<?php

session_start();
include_once "../php/classes/BOPics.php";
$pics = new BOPics;
$mime = array('image/JPG','image/JPEG','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');


if(isset($_FILES['file'])){
	$t = count($_FILES['file']['name']); // normalWay();
}else{
	$t = sizeof($_FILES); // fallback();
}


for($i = 0; $i < $t; $i++){

	if(isset($_FILES['file'])){// normalWay();

			if($_FILES['file']['size'][$i] > 9000000000000) 
			{
				echo '<span>muy grande desde php</span>';
				return;
			}
			if(!in_array($_FILES['file']['type'][$i], $mime )){
				
				echo '<span>formato invalido desde php</span>';
				return;
			}

			$file = $_FILES['file']['tmp_name'][$i];
			$fileName = $_FILES['file']['name'][$i];

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
	}

	$path = "../img";
	$rand = rand(1000,9999);
	$ext = pathinfo($fileName, PATHINFO_EXTENSION);
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
	$max_ancho = 220 ;
	$max_alto = 2000 ;

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
		