<?php

session_start();
include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BONews.php";

$u = new BOUsers; // lo instancio aca para q ande news y no joda album. Testealo por las dudas....
$news = new BONews;
$news->deleteNews($_POST['n']);

$_GET['u'] = $_SESSION['id']; //imprimo esto para poder tener un response.text con el id del usuario y que deje de tirar el error de la variable U

include_once "../templates/userNews.php";
	
