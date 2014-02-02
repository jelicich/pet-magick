<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);
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

		<div id='what'>
		<a href="#" ><p>How does Project board work ?</p></a>
		<div class='active five_pixels'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					Losing a pet can be a very traumatic experience for those who have formed a close bond with their good
					friend and companion.
					So we've added this Wall 
					of Rememberance, a place 
					where you can create a memorial to your special friend and let the rest of the world know of the special times you had together. 
					You can add your favorite pet photo, and write a short tribute to your loyal mate.
					There's also some space for other members to post
					messages of support, so if 
					you are struggling with greif, others can help you 
					through the pain and let
					the healing process begin.
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
				
				<ul class='grid-thumbs clearfix mod-content' id='ModulesByPet'> 
					<?php 
						
						include_once 'templates/petLossModule.php'; 
					?>
				</ul>	
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
</script>

</body>
</html>
