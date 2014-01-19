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
		
		<!-- profiles module -->
		<div id='profiles-mod' class='mod grid_12'>
			<div class='mod-header'>
				<ul class='clearfix mod-menu' id='menuByPet'>
					
					<li id='dog'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#1'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Dog
							<div id='arrow-dog'></div>
						</a>
					</li>

					<li id='cat'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#2'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Cat
							<div id='arrow-cat'></div>
						</a>
					</li>

					<li id='bird'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#3'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Bird
							<div id='arrow-bird'></div>
						</a>
					</li>

					<li id='rabbit'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#rabbit'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Rabbit
							<div id='arrow-rabbit'></div>
						</a>
					</li>

					<li id='ferret'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#ferret'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Ferret
							<div id='arrow-ferret'></div>
						</a>
					</li>

					<li id='others'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
						<a href='#'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
							Others
							<div id='arrow-others'></div>
						</a>
					</li>
				</ul>
			</div>
				<ul class='grid-thumbs clearfix mod-content' id='profilesModuleByPet'> 
					<?php 
						
						include_once 'templates/profilesModule.php'; 
					?>
				</ul>	
				
		</div>
		<!-- END profiles module -->

		<!-- ads -->
		<div class="grid_6 asd" >
		</div>
		<div class="grid_6 asd">
		</div>
		<!-- END ads -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->
<script type="text/javascript">
	usersByPet();
</script>
</body>
</html>
