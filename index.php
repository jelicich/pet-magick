<?php 
	session_start();
	$_SESSION['token'] = sha1(uniqid()); 

	
	if(isset($_GET['r'])){ 
		//'8a660044249e8cf14a447c6aa513ee66177d7ed7'
		include_once('php/classes/BOUsers.php');
		$u = new BOUsers;

		//to por url el token q le mlande por mail al user
		$confirmation  = $u->confirm_subscription($_GET['r']);

		// evaluo q coincida con el token de la bd
		if($confirmation != false){

			// logueo al user como hacemos normalmente
			$u->login($confirmation[0]['EMAIL'], $confirmation[0]['PASSWORD'], $confirmation[0]['TOKEN']);

			//guardo en sesion datos q pueda llegar a necesitar
			$_SESSION['id'] = $confirmation[0]['ID_USER'];
			$_SESSION['datelog'] = date('Y-m-d H:i:s');
			$_SESSION['name'] = $confirmation[0]['NAME'];
			$_SESSION['lastname'] = $confirmation[0]['LASTNAME'];
			$_SESSION['nickname'] = $confirmation[0]['NICKNAME'];
			$_SESSION['email'] = $confirmation[0]['EMAIL'];

			//cargo el html con el menu del usuario
			/*if(isset($_POST['url']) && $_POST['url'] == 1)
			{
				include_once 'templates/userMenuBlog.php';
			}
			else
			{
				include_once 'templates/userMenu.php';
			}
			//cacheo la info para las herramientas de busqueda
			*/
			include_once 'ajax/autoCompleteEverything.php';
		
		}else{

			//echo "cagamos"; exit;
		}
	}
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
<link rel="stylesheet" href="css/videos.css" type="text/css" />
<link type="text/css" href="video/skin/jplayer.blue.monday.css" rel="stylesheet" />
<!-- <script src="http://code.jquery.com/jquery.js"></script>
<script src="js/jquery.js"></script> 
 <script type="text/javascript" src="js/bootstrap.js"></script>  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>

<?php 
		include_once 'templates/No_IE.php'; 
?>

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
					<ul class='mod-content clearfix videoCap videoIndex'>
					<?php 
						$s = 'index'; // esta variable define cuantas fotos habra en el modulo	
						include_once 'templates/latestVideosModule.php';
					?>
					</ul>

			</div>
			<!-- END animal antics module -->

			<!-- pet loss module -->
			<div class="mod pet-loss-mod petlistindex">
				<div class="mod-header">
					<h2>Visit wall of rememerance</h2>
					<span>Leave a message of support for other pet lovers</span>
				</div>

				<ul class="mod-content pet-loss-mod-list">
					<?php 
						include_once 'templates/petLossIndexModule.php'; 
					?>
				</ul>
				
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


<script type="text/javascript">
	video();
</script>

</body>
</html>
