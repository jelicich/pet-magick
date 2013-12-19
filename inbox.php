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

<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content" style="height:100%">
		<div id="what">
			<a href="#" id='new-message'>New Message</a>
		</div>
		
		<div class="grid_4" id="conv-area">
			<ul id="wrap-conversations"></ul>
		</div>	

		<div class="grid_8" id="message-area">
			<ul id="wrap-messages"> <!-- scroleable -->
			</ul>

			<form method='' action='' class="clearfix" style="display:none" id="write-message">	
				

				<textarea rows='5' cols='30' name='message' id='message'></textarea>
				<input type='button' value='Submit' id='send-message' class="btn btn-danger"/>

				
			</form>
		</div><!-- END message area -->



		

		
</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<form method='' action='' class="clearfix" style="display:none" id="write-new-message">	
				

			<div id='searchField'>
					<input type='text' placeholder='To' id='inputTo' name='inputTo'/>
					<input type='hidden' id='id-recipient' name='recipient'/> 
			</div>
			
			<textarea rows='5' cols='30' name='message' id='message'></textarea>
			<input type='button' value='Submit' id='send-message' class="btn btn-danger"/>
		
		</form>
</body>


<script type="text/javascript" id="jslogout">

	inbox(); //============= Carga los mensajes
	searchField();


</script>


</html>
