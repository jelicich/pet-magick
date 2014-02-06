<?php

session_start();



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	include_once "../php/classes/BOAnswers.php";
	include_once "../php/classes/BOQuestions.php";

	$q = new BOQuestions;
	$a = new BOAnswers;
	
	if($a->post($_POST))
	{
		$la = $a->getLastAnswerId();
		if(!$q->addAnswerId($la, $_POST['id']))
		{
			echo json_encode($q->getErr());
		}
	}

	
}
else
{
	echo json_encode("Request method error");
}


?>