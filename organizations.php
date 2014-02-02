<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOOrganizations.php";
	include_once "php/classes/BOPics.php";

	$org = new BOOrganizations;
	$pics = new BOPics;
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

	<div id="content" class="mod container_12" >

	<div id='what' >
		<a href="#"><p>Que carajo ponemos aca ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					It's time to make your pet a star. Show the rest of the world those moments your pet has done those "amazing...zany...pull your hair out" things that only pets can do and you've managed to capture on video. 
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>

	<!-- featured project module -->
	<div class="mod grid_12 org-mod nogrid-mod" id='featured-org'>
		<?php 
			include_once 'templates/featuredOrganizationsModule.php'; 
		?>
	</div>
	<!-- END featured project module -->


	<!-- Current projects module -->
		<?php 
			include_once 'templates/organizationListModule.php'; 
		?>
	<!-- END Current projects module -->


		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->
		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


<script type="text/javascript">
	selectedFromList('featured-org', 'ajax/getSelectedOrg.php?p=');
</script>

</body>
</html>
