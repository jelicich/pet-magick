<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	//include_once "php/classes/BOProjects.php";
	//include_once "php/classes/BOPics.php";

	//$projects = new BOProjects;
	//$pics = new BOPics;

	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
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
<script type="text/javascript" src="js/scroll.js"></script> 

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
		<a href="#"><p>How does Project board work ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo $pop->getPopUps("projects") ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>

	<!-- featured project module -->
		<div class="mod grid_12 projects-mod nogrid-mod" id='featured-project'>
			
			<?php 
				include_once 'templates/featuredProjectModule.php'; 
			?>

		</div>
		<!-- END featured project module -->


		<!-- Current projects module -->
		<div class="mod grid_12 projects-mod list ">
			<div class="mod-header">
				<h2>Current projects</h2>
			</div>

			<?php 

				include_once 'templates/projectListModule.php'; 
			?>

		</div>
		<!-- END Current projects module -->

		<!-- ads -->
		<div class="grid_6 asd" ></div>
		<div class="grid_6 asd"></div>
		<!-- END ads -->

	

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


<script type="text/javascript">
	selectedFromList('featured-project', 'ajax/getSelectedProject.php?p=');
	start_scroll('scrollable-list');
	
</script>

</script>

</body>
</html>
