<?php
session_start();
include_once "../php/classes/BOUsers.php";
include_once('../php/classes/BOLocation.php');

$p = new BOUsers;
$p->getUserData($_SESSION['id']);

$location = new BOLocation;
$countries = $location->countryList();


include_once '../templates/editUser.php';


?>