<?php


	if($u->autoCompleteEverything()){

		$searchTool = 'ajax/searchTool.php';
		file_put_contents($GLOBALS['searchTool'], $u->getCompleteEverything());
		file_get_contents($searchTool);
	}
