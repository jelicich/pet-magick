<?php

session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	include_once "../php/classes/BOQuestions.php";

	$c = new BOQuestions;
	if($c->post($_POST))
	{
		echo $c->getSentQuestion();
	}
	
}
else
{
	echo "Request method error";
}


?>