<?php 
function chkadmin()
{
	if(!$_SESSION['rank'] || $_SESSION['rank'] != 2)
	{
		header("Location: index.php");	
	}
	else
	{
		return;
	}	
}
