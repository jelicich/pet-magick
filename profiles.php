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
				<ul class='clearfix mod-menu'>
					<li id='dog'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Dog
							<div id='arrow-dog'></div>
						</a>
					</li>

					<li id='cat'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Cat
							<div id='arrow-cat'></div>
						</a>
					</li>

					<li id='bird'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Bird
							<div id='arrow-bird'></div>
						</a>
					</li>

					<li id='rabbit'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Rabbit
							<div id='arrow-rabbit'></div>
						</a>
					</li>

					<li id='ferret'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Ferret
							<div id='arrow-ferret'></div>
						</a>
					</li>

					<li id='others'>
						<a href='#'> <!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
							Others
							<div id='arrow-others'></div>
						</a>
					</li>
				</ul>
			</div>
			
				<?php 
					include_once 'templates/profilesModule.php'; 
				?>
				
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
</body>
</html>
