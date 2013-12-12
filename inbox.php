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
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />

<script type="text/javascript" src="js/hola2.js"></script>

</head>

<body>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">
		
		<div class="grid_5">
			<ul id="wrap-conversations"></ul>
		</div>	

		<div class="grid_7" id="wrap-messages"></div>	

		<form method='' action='' class="grid_12" style="display:none" id="write-message">	
			<input type='text' placeholder='To' id='inputTo' /><br><br>
			<textarea rows='5' cols='30' name='message' id='message'></textarea><br><br>
			<input type='button' value='Submit' id='send-message'/>
		</form>

		<input type='button' value='New message' id='new-message'/>
</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->
</body>







<script type="text/javascript" id="jslogout">

	inbox(); //============= Carga los mensajes


</script>


</html>
