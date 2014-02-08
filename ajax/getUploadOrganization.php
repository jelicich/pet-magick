<?php
session_start();
include_once "../php/classes/BOOrganizations.php";

$o = new BOOrganizations;

include_once '../templates/uploadOrganization.php';


?>