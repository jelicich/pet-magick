<?php
include_once "funciones.php";
include_once "../../functions/funciones.php";
$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg');
//$tam = getimagesize($_FILES['img']['tmp_name']);

//valido q estén los datos necesarios
if($_POST['tit'] == "" || $_POST['desc'] == "" || !$_FILES['img']['tmp_name'])
{
	header('Location: ../backend.php?ex&er=1');
}
else if (!in_array( $_FILES['img']['type'], $mime )) 
{
	header('Location: ../backend.php?ex&er=2');
}
else if( $_FILES['img']['size'] > 900000 ) 
{
	header('Location: ../backend.php?ex&er=3');
}
else
{
	//adslashes para escapar caracteres raros y poder subirlos a la base.
	$tit = addslashes($_POST['tit']);
	$desc = addslashes($_POST['desc']);
	$fecha = $_POST['datepicker'];
	$ruta = "img/expo/gr/";
	$link = $ruta.$nuevo_nombre; // path foto
	$link2= "img/expo/sm/".$nuevo_nombre; // path para thumb

	//genero el nombre
	$archivo = $_FILES['img']['tmp_name'];
	$nombreArchivo = $_FILES['img']['name'];
	$rand = rand(1000,9999);
	$nuevo_nombre = $rand . "_" . time() .'.' . end(explode(".",strtolower($nombreArchivo)));  
	//guardo el archivo en la ruta para fotos grandes
	move_uploaded_file($archivo, "../../../srl/".$ruta.$nuevo_nombre);
	$link = $ruta.$nuevo_nombre;
	$link2= "img/expo/sm/".$nuevo_nombre; //para thumb

	//creo thumb ------------------------
	//levanto la imagen que acabo de guardar
	$imgOriginal = "../../../srl/img/expo/gr/".$nuevo_nombre ;

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

	imagedestroy( $img_original ) ;

	$calidad = 100 ;

	imagejpeg( $imgNueva, '../../../srl/img/expo/sm/' . $nuevo_nombre, $calidad ) ;

	//guardo todo en la base
	$link = $ruta.$nuevo_nombre;
	$c = conectar2();
	$q = "INSERT INTO expos VALUES ('', '".$tit."', '".$desc."', '".$fecha."', '".$link2."', '".$link."');";
	$id=insertarConID($c,$q);

	header('Location: ../backend.php?ex&msgup');
}
/*
$nombre = "ARCHIVO.JPEG";
$rand = rand(1000,9999);
$nuevo_nombre = $rand . "_" . time() .'.' . end(explode(".",strtolower($nombre)));  

echo $nuevo_nombre;
*/