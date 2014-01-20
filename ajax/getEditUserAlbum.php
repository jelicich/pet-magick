<?php
session_start();
include_once "../php/classes/BOUsers.php";


$u = new BOUsers;
//Llega por get el id de la mascota
$u->getUserData($_GET['u']);

include_once '../templates/editUserAlbum.php';


?>