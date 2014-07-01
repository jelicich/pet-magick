<?php 
	session_start();
	$_SESSION['token'] = sha1(uniqid()); 
	/** 
	Agrego esto para chequear q el user este logueado. Hay q ver si el valor q tomo por session es el q queremos.
	Es mas largo traerlo de la clase q pegar la funcion, pero me parecio mejor asi...
	**/
	include_once "php/classes/BOUsers.php";
	$user = new BOUsers;
	//if(!$user->checklogin())
		//header('Location: index.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pet Magick is a global social network for pet and animal lovers to connect and share the joy that animal companions bring into their life. A place where those grieving with pet loss can get support from others who've been through the same traumatic experience.">
<meta name="keywords" content="pet lovers,pet owners,pet loss,funny pet videos,pet health,animal health,pet information,animal rescue,pet stories,dog club,cat club">

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


<?php
if($user->checklogin())
{
?>

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
<?php 
if(isset($_GET['to']))
{
	$tempU = new BOUsers;
	if($q = $tempU->findName($_GET['to']))
		$name = $q[0]['NAME'].' '.$q[0]['LASTNAME'];
	else
		$name = 'Error retrieving the user';

?>
<form method='' action='' class="clearfix" style="display:block" id="write-new-message">	
				

	<div id='searchField' class="grid_3">
			<input type='text' placeholder='To' id='inputTo' name='inputTo' autocomplete='off' style="display:none"/>
			<span id="recipient-name"><?php echo $name; ?></span>
	</div>
	
	<textarea rows='5' cols='30' name='new-message' id='new-message'></textarea>
	<input type='button' value='Submit' id='send-new-message' class="btn btn-danger"/>
	<input type="button" value='Cancel' id="cancel-new-message" class="btn btn-danger"/>

</form>
<?php
} //end if isset GET to
else
{
?>
<form method='' action='' class="clearfix" style="display:none" id="write-new-message">	
				

	<div id='searchField' class="grid_3">
			<input type='text' placeholder='To' id='inputTo' name='inputTo' autocomplete='off'/>
	</div>
	
	<textarea rows='5' cols='30' name='new-message' id='new-message'></textarea>
	<input type='button' value='Submit' id='send-new-message' class="btn btn-danger"/>
	<input type="button" value='Cancel' id="cancel-new-message" class="btn btn-danger"/>

</form>
<?php 
}//end else isset GET to
?>

<script type="text/javascript" id="jslogout">

	inbox(); //============= Carga los mensajes
	
	var i = new autoSearch('inputTo');
	i.ini({
		'hidden':true
		<?php if(isset($_GET['to'])) echo ",'to':".$_GET['to'] ?>
	});


	//start_scroll('scrollable', false);
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

	$(".scrollable").mCustomScrollbar(
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

<?php
}//end if checklogin
else
{ 
?>
<div id="wrapper" class="h100">
	
	<?php 
		include_once 'templates/header.php'; 
	?>
	<div class="container_12" id="content">
		<div class="grid_12"><p class="alert alert-danger">You must be logged in to send and recieve messages</p></div>
	</div>

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<?php
}//end else checklogin
?>
</body>

</html>
