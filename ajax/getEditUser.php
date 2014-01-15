<?php
session_start();

if(!isset($_POST['u']) || $_POST['u'] != $_SESSION['id'])
{
	echo 'Session ERROR';
	die;
}

include_once "../php/classes/BOUsers.php";
include_once('../php/classes/BOLocation.php');

$p = new BOUsers;

$p->getUserData($_POST['u']);

$location = new BOLocation;
$countries = $location->countryList();


include_once '../templates/editUser.php';


?>