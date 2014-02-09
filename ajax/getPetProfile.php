<?php
session_start();
//include_once "../php/classes/BOProfiles.php";
//$p = new BOProfiles($_SESSION['current-profile']);

include_once "../php/classes/BOPets.php";
$p = new BOPets;

include_once('../php/classes/BOVideos.php');
$v = new BOVideos;
$p->getPetData($_GET['p']);


include_once '../templates/petProfile.php';

?>