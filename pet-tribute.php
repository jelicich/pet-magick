<?php 
	session_start();
	//session_destroy();
	//var_dump($_SESSION);
	include_once 'php/classes/BOTributes.php';
	include_once 'php/classes/BOComments.php';
	$t = new BOTributes;
	$a = $t->getTribute($_GET['t']);
	$c = new BOComments;
	$com = $c->getComments($_GET['t']);

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
		
			<!-- about module -->
			<?php 
				include_once 'templates/petTributeModule.php'; 
			?>
			<!-- END about module -->

			<!-- Messages module-->
			<?php 
				include_once 'templates/tributeMsgModule.php'; 
			?>
			<!-- END Current projects module -->

	</div>
	<!-- END site content -->
	
			<?php 
				include_once 'templates/footer.php'; 
			?>

</div>
<!-- END wrapper-->

<script type="text/javascript">

	modalImg();
	tributeComments();

</script>
</body>
</html>
