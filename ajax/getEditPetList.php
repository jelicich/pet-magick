<?php
session_start();
include_once "../php/classes/BOProfiles.php";
include_once('../php/classes/BOLocation.php');

$p = new BOProfiles($_SESSION['id']);


//include_once '../templates/editUser.php';


?>