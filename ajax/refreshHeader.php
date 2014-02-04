<?php

session_start();
include_once "../php/classes/BOUsers.php";
$u = new BOUsers;
$u->getUserData($_SESSION['id']);

$_SESSION['thumb'] = $u->getThumb();
$_SESSION['name'] = $u->getName();
$_SESSION['lastname'] = $u->getLastname();

include_once('../templates/userMenu.php');