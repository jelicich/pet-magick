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

<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">
		
		<div class="grid_5">
			<ul id="wrap-conversations">

			</ul>
		</div>	

		<div class="grid_7" id="wrap-messages">
		</div>	




<form method='' action='' class="grid_12">

	<input id='from' type='hidden' name='from' value=<?php echo '"'. $_SESSION['id'] . '"'; ?> />
	<input type='text' name='to' placeholder='to (email)' id='to' /><br>
	<input type='text' name='subject' placeholder='subject' id='subject' /><br>
	<textarea rows='5' cols='30' name='message' id='message'></textarea><br><br>

	<input type='button' value='Submit' id='submit'/>


</form>

				


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
