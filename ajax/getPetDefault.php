<?php
session_start();
//include_once "../php/classes/BOProfiles.php";
//$p = new BOProfiles($_SESSION['current-profile']);

include_once "../php/classes/BOPets.php";

$p = new BOPets;
$pets = $p->getPetList($_GET['u']);
if($pets)
{	
		include_once('../php/classes/BOVideos.php');
		$v = new BOVideos;
	$p->getPetData($pets[0]['ID_PET']);
	include_once '../templates/petProfile.php';


}


?>