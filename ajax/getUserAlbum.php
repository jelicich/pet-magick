<?php
session_start();
//include_once "../php/classes/BOProfiles.php";
//$p = new BOProfiles($_SESSION['current-profile']);

include_once "../php/classes/BOUsers.php";
$u = new BOUsers;
if(isset($_POST['u']))
	$id = $_POST['u'];
if(isset($_GET['u']))
	$id = $_GET['u'];

$u->getUserData($id);


include_once '../templates/userAlbum.php';

?>