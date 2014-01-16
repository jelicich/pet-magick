<?php

session_start();
include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BONews.php";

$news = new BONews;
$news->deleteNews($_POST['n']);

include_once "../templates/userNews.php";
	
