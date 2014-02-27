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
	<div class="container_12" id="content">

		<div id='what'>
		<a href="#" ><p>How does Project board work ?</p></a>
		<div class='active five_pixels'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo $pop->getPopUps("petloss") ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>

		
		
		<!-- pet loss module -->
		<div  class="pet-loss-mod mod grid_12">
			<?php 
						
				include_once 'templates/modHeader.php'; 
			?>
				<div class="scrollable-module">
					<ul class='grid-thumbs clearfix' id='ModulesByPet'> 
						<?php 
							
							include_once 'templates/petLossModule.php'; 
						?>
					</ul>	
				</div>
		</div>
		<!-- END profiles module -->

	

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<script type="text/javascript">
	listByCategory('tributesModuleByPets.php'); // ACA HAY Q HACER UN ajax/php para traer mascotas muertas (tributos)
	start_scroll('scrollable-module');

	$(".mod-menu li").click(function(){
		$(this).find("div").attr("class", "arrow-pet-loss");
	});

</script>

</body>
</html>
