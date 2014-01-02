<?php
session_start();
include_once "../php/classes/BOProfiles.php";
$p = new BOProfiles($_SESSION['current-profile']);


include_once '../templates/petProfile.php';

?>