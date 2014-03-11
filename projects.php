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
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
 <script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 
<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->

	<div id="content" class="container_12" >

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
		<div class="mod grid_8 projects-mod list ">
			<div class="mod-header">
				<h2>Current projects</h2>
			</div>
			<div class="scrollable-list-sections" id="projectsList">

				<?php 
					include_once 'templates/projectListModule.php'; 
				?>
			</div>
		</div>
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
	selectedFromList('featured-project', 'ajax/getSelectedProject.php?p=');
	start_scroll('scrollable-list-sections', false);
	//start_scroll('scrollable-text');

</script>

</script>

</body>
</html>
