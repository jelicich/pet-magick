<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pet Magick</title>

		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">

		<script src="../js/jquery.js"></script> 
	 	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	<!--	<script type="text/javascript" src="bootstrap/js/lib.js"></script> -->
</head>


<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
	
	#pop-upsModule{
		margin-top: 100px;
	}
</style>

</head>
<body>
<div class="container-fluid">

	<?php
		include_once("templates/header.php");
	?>
	
</div>


<script type="text/javascript">
	/*
	var save = $(".save");

	save.click(function(event){
  			
  			event.preventDefault();
  			alert('hola');

	});
	*/
</script>

</body>
</html>

