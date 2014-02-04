<?php
session_start();
include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOAnimalCategories.php";

$p = new BOPets;
//Llega por get el id de la mascota
//$p->getPetData($_GET['P']);

$ac = new BOAnimalCategories;

include_once '../templates/addPet.php';


?>