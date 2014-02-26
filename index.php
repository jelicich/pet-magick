<?php 
	session_start();
	$_SESSION['token'] = sha1(uniqid()); 

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

<!-- <script src="http://code.jquery.com/jquery.js"></script>
<script src="js/jquery.js"></script> 
 <script type="text/javascript" src="js/bootstrap.js"></script>  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 


<!--[if lte IE 8]> <link rel="stylesheet" href="css/ie/ie_index_8.css" type="text/css" /> <![endif]-->
<!--[if IE 7]> <link rel="stylesheet" href="css/ie/ie_index_7.css" type="text/css" /> <![endif]-->

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<div id="wrapper">

	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">
		

		<!-- left wrapper -->
		<div class="grid_7" id="left-wrapper">
			<!-- profiles module -->
			
				<div class="mod profiles-mod">
					<div class="mod-header">
						<h2>Connect with other pet lovers</h2>
						<span>Connect with other pet lovers in your area, age group, or pet type</span>
					</div>
					<!-- user -->
					<ul class='grid-thumbs clearfix mod-content ' id='profilesModuleByPet' >
						<?php 
							$_GET['s'] = 0; // lo utilizo para el limit. o representa a index.php
							include_once 'templates/profilesModule.php'; 
						?>
					</ul>
				</div>
			
			
			<!-- END profiles module -->

			<!-- projects module -->
			<div class="projects-mod mod">
				<div class="mod-header">
					<h2>Current projects</h2>
					<span>Make a positive contribution to this community</span>
				</div>
				<?php 
					include_once 'templates/projectListModule.php'; 
				?>
			</div>
			<!-- END projects module -->

		</div>
		<!-- END left wrapper -->

		<!-- right wrapper -->
		<div class="grid_5">
			
			<!-- animal antics module -->
			<div class="mod animal-antics-mod  clearfix"> <!-- animal-antics-mod lo converti de id a class para q sea como profiles-mod ya q compartian algunas cosas -->
				<div class="mod-header">
					<h2>Laugh with other pet lovers</h2>
					<span>Upload those videos of your pet doing crazy funny things!</span>
				</div>
				
				<div class='video mod-content'>
					<?php 
						$s = 'index'; // esta variable define cuantas fotos habra en el modulo	
						include_once 'templates/latestVideosModule.php';
					?>
				</div>

			</div>
			<!-- END animal antics module -->

			<!-- pet loss module -->
			<div class="mod pet-loss-mod">
				<div class="mod-header">
					<h2>Visit wall of rememerance</h2>
					<span>Leave a message of support for other pet lovers</span>
				</div>

				<div class="mod-content pet-loss-mod-list">
					<?php 
						include_once 'templates/petLossIndexModule.php'; 
					?>
				</div>
			</div>
			<!-- END pet loss module -->
			
		</div>
		<!-- END right wrapper -->
		
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




</body>
</html>
