<?php

session_start();
include_once "../php/classes/BOPets.php";
include_once "../php/classes/BOUsers.php";
$p = new BOPets;
$u = new BOUsers;

$_GET['u'] = $_SESSION['id'];
$userId = $_SESSION['id'];
$pets = $p->getPetList($_SESSION['id']);

if($pets)
{
	include_once('../templates/petList.php');
}

