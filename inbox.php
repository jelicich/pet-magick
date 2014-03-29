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
<div id="wrapper" class="h100">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content" style="height:100%">
		
		<div id="what">
			<a href="#" id='btn-new-message'>New Message</a>
		</div>
		
		<div class="grid_4 scrollable" id="conv-area">
			<ul id="wrap-conversations"></ul>
		</div>	

		<div class="grid_8" id="message-area">
			<div class="scrollable-msg" id="wrap-messages-container">
				<ul id="wrap-messages"> 
				</ul>
			</div>
		</div><!-- END message area -->
		
		<div class="grid_8" id="write-message-container">
			<form method='' action='' class="clearfix" style="display:none" id="write-message">					
				<textarea rows='5' cols='30' name='message' id='message'></textarea>
				<input type='button' value='Submit' id='send-message' class="btn btn-danger"/>	
			</form>
		</div>
		
	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<form method='' action='' class="clearfix" style="display:none" id="write-new-message">	
				

	<div id='searchField' class="grid_3">
			<input type='text' placeholder='To' id='inputTo' name='inputTo' autocomplete='off'/>
	</div>
	
	<textarea rows='5' cols='30' name='new-message' id='new-message'></textarea>
	<input type='button' value='Submit' id='send-new-message' class="btn btn-danger"/>
	<input type="button" value='Cancel' id="cancel-new-message" class="btn btn-danger"/>

</form>


<script type="text/javascript" id="jslogout">

	inbox(); //============= Carga los mensajes
	
	var i = new autoSearch('inputTo');
	i.ini({
		'hidden':true
	});

	start_scroll('scrollable', false);
	$(".scrollable-msg").mCustomScrollbar(
	{
		scrollButtons:
		{
			enable: false 
		},

		advanced:
		{
			updateOnContentResize: false,
		},

		theme:"light-thin",


	});


</script>
</body>

</html>
