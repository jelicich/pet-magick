<?php

	if($user->autoCompleteEverything()){

		$searchTool = 'searchTool.php';
		file_put_contents($GLOBALS['searchTool'], $user->getCompleteEverything());
		file_get_contents($searchTool);
	}
