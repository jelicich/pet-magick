<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

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
<script type="text/javascript" src="js/preloader.js"></script> 

<script type="text/javascript" src="js/lib.js"></script>


</head>

<body>

<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>

<div id="wrapper">
	

	<?php 
		include_once 'templates/header.php'; 
	?>


	<!-- site content -->

	<div id="content" class="mod container_12" >

	<div id='what' >
		<a href="#"><p>What is animal antics ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo $pop->getPopUps("antics") ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>
		
		
		<!-- lastest videos -->
		<div id="lastest-video-mod" class="mod grid_9">
			
			<div class="mod-header">
				<h2>Latest videos</h2>
			</div>

			<ul class='mod-content clearfix'>
				<?php 
					$s = 'antics'; // esta variable define cuantas fotos habra en el modulo	
					include_once 'templates/latestVideosModule.php';
				?>
			</ul>
	

		</div>
		<!-- End lastest videos -->

		<!-- advertisement -->
		<div id="publi" class="mod grid_3">
		</div>


		
		<!-- videos module -->
		<div class="mod profiles-mod animal-antics-mod grid_12 ">
			<?php 
						
				include_once 'templates/modHeader.php'; 
			?>
			
			<ul class='grid-thumbs clearfix mod-content scrollable-module' id='ModulesByPet'> 
					<?php 
						
						include_once 'templates/anticsModule.php'; 
					?>
			</ul>	
		</div>
		<!-- END video module -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


	<?php 
		include_once 'templates/player.php'; 
	?>
	
<script type="text/javascript">
	listByCategory('anticsModuleByCategory.php');
	start_scroll('scrollable-module');
</script>


</body>
</html>
