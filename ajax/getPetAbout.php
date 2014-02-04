<?php
session_start();
//include_once "../php/classes/BOProfiles.php";
//$p = new BOProfiles($_SESSION['current-profile']);

include_once "../php/classes/BOPets.php";
$p = new BOPets;
$p->getPetData($_GET['p']);


include_once '../templates/petAbout.php';

?>