<?php 
	session_start();
	$_SESSION['token'] = sha1(uniqid()); 
	/** 
	Agrego esto para chequear q el user este logueado. Hay q ver si el valor q tomo por session es el q queremos.
	Es mas largo traerlo de la clase q pegar la funcion, pero me parecio mejor asi...
	**/
	include_once "php/classes/BOUsers.php";
	$user = new BOUsers;
	$user->checklogin();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 

</head>

<body>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content" style="height:100%">
		
		<h2 class="err404">500</h2>
		<h3 class="err404">error</h3>
		<h2 class="err">Internal server error.</h2>
		<p class="err">We're experiencing some technical difficulties. We apologize for the inconvenience and suggest trying again in a few minutes</p>
		
	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

</body>

</html>
