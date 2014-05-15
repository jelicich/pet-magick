<?php

session_start();
include_once "../php/classes/BOOrganizations.php";

$org = new BOOrganizations; 
include_once '../templates/editOrganization.php';


?>