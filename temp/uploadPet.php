<?php


include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOPics.php";
include_once "../php/classes/BOVideos.php";

function rand_string( $length ) {
	$chars = "abcdefgh ijklmnopqrs tuvwxyz ABCDEFGH IJKLMNOPQRS TUVWXYZ ";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}

for($i = 0; $i < 100; $i++)
{



	$p = new BOPets;
	$names = array('Pedro', 'Pablo', 'Carlos', 'Chichi', 'Colita', 'Kiki', 'Titi', 'Chochi', 'Hugo', 'Tulio', 'Bruno', 'Elvis', 'Celina', 'Lorenzo', 'Lamas', 'Susana', 'Gimenez', 'Mirta', 'Legrand', 'Robert', 'Deniro', 'Wacho', 'Puto', 'Miguel', 'Tuvieja', 'Forro', 'Hola', 'Que', 'Como', 'Cuando','Porque', 'Tute', 'Caquita', 'Sorete', 'Culo', 'Dr. Culo', 'Si', 'No', 'Hasta', 'Zohan', 'Humus', 'Bubbles', 'Matuke','Matuta', 'Morales', 'Diogenes', 'Forrazo', 'Carlim', 'Carlina', 'Carlota', 'Cinicia','Cire', 'Circe','Ciriaca', 'Cyrilla','Cien','Putongo','Pantufla','Cuadro','TV','Calavera', 'Cala','Cactus','Potus','Putus','Forrus', 'Boludus', 'Agua', 'Buda', 'Ala', 'Mahoma', 'Mustfa', 'Yoda', 'Etc' );
	$randNam = rand(0,sizeof($names)); 
	$name = $names[$randNam];
	$cat = rand(1,6);
	$lengthTit = rand(10,100);
	$title = rand_string($lengthTit);
	$lengthMsg = rand(50,200);
	$msg = rand_string($lengthMsg);
	$u=rand(5,34);

	$array = array('name' => $name, 'animal-category' => $cat, 'create-tribute' => true, 'tr-title' => $title, 'tr-msg'=> $msg, 'u'=> $u );

	//var_dump($_POST);


	$idPet = $p->addPet($array);
	if(!$idPet)
	{
		include_once "../php/classes/BOAnimalCategories.php";
		$ac = new BOAnimalCategories;
		$err = $p->getErr();
		echo '<p>Error creating new pet</p><ul class="error upload-pet">';
		for($i=0; $i < sizeof($err); $i++)
		{
			echo '<li>'.$err[$i].'</li>';
		}
		echo '</ul>';
		//$_GET['u'] = $_POST['u'];
		//include_once "../templates/addPet.php";
		
	}
	else
	{
		
		echo 'Mascota '.$name.' creada<br/>';

		if(isset($array['create-tribute']))
		{
			include_once '../php/classes/BOTributes.php';
			$t = new BOTributes;
			$array['p'] = $idPet;
			$idTr = $t->createTribute($array);
			if(!$idTr)
			{
				$err = $t->getErr();
				echo '<p>Error creating the tribute</p><ul class="error upload-tribute">';
				for($i=0; $i < sizeof($err); $i++)
				{
					echo '<li>'.$err[$i].'</li>';
				}
				echo '</ul>';
			}
			else
			{
				echo 'Tributo '.$name.' creado<br/>';
			}
		}
	}




}//for






