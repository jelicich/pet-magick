<?php

session_start();
include_once "../php/classes/BOPics.php";
$pics = new BOPics;



//$size = getimagesize($_FILES['file']['tmp_name']);
//$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
   //var_dump($size);
var_dump($_FILES);
$count = count($_FILES['file']['name']);
/*
////
if($count <= 1){ // Provisorio para IE 7
	
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

}else{// Esta es la posta, lo q va dentro del for
*/	
		for($i = 0; $i < $count; $i++)
		{
			$path = "../img";
			$file = $_FILES['file']['tmp_name'][$i];
			$fileName = $_FILES['file']['name'][$i];
			$rand = rand(1000,9999);
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$newName = $rand . "_" . time() .'.' . $ext;  
			move_uploaded_file($file, $path.'/'.$newName);
			$path = $path.'/'.$newName;
			//$caption = $_POST['caption'];
			$caption = 'provisorio!!!!!!';
		    
			//$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));
			$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));

		}

//}
/*	

	<?php

session_start();
include_once "../php/classes/BOPics.php";
$pics = new BOPics;

    
      $count = count($_FILES['file']['name']);

      for($i = 0; $i < $count; $i++)
      {
      		$path = "../img";
			$file = $_FILES['file']['tmp_name'][$i];
			$fileName = $_FILES['file']['name'][$i];
			$rand = rand(1000,9999);
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$newName = $rand . "_" . time() .'.' . $ext;  
			move_uploaded_file($file, $path.'/'.$newName);
			$path = $path.'/'.$newName;
			//$caption = $_POST['caption'];
			$caption = 'provisorio!!!!!!';
			
			$pics->upload_img(array('pic'=>$path, 'caption'=>$caption));

      }

      */