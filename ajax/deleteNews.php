<?php

session_start();
//var_dump($n);
include_once "../php/classes/BOUsers.php";
include_once "../php/classes/BONews.php";

$n = new BONews;
$u = new BOUsers; 

$newsid = $_POST['n'];
if(!$n->deleteNews($newsid))
{
	echo $n->getErrors();
}
else
{
	$_GET['u'] = $_SESSION['id'];
	include_once "../templates/userNews.php";	
}

	
?>