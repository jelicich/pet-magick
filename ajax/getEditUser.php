<?php
session_start();
include_once "../php/classes/BOProfiles.php";
include_once('../php/classes/BOLocation.php');
$p = new BOProfiles($_SESSION['current-profile']);

$country = new BOLocation;
$countries = $country->countryList();


include_once '../templates/editUser.php';


?>