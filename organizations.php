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
		<div class="mod grid_12 org-mod nogrid-mod">
			
			<div class="mod-header">
				<h2>Featured organization</h2>
			</div>
			
			<div class="mod-content clearfix">
				
				<div class="pic-caption">
					<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					<h3>Kali</h3>
					<span>Kelpy X</span> <br>
					<span>1998 - 2010</span>
			
				</div>
				
				<div class="bg-txt txt-wider">
					
					<p>
						El equipo de Carlos Bianchi debe ganar para aprovechar la oportunidad de quedar a un punto de la cima tras el empate de San Lorenzo. Recibirá al elenco de Floresta, que tendrá el debut de Ricardo Rodríguez como DT. Desde las 18:15. El equipo de Carlos Bianchi debe ganar para aprovechar la oportunidad de quedar a un punto de la cima tras el empate de San Lorenzo. Recibirá al elenco de Floresta, que tendrá el debut de Ricardo Rodríguez como DT. Desde las 18:15
						El equipo de Carlos Bianchi debe ganar para aprovechar la oportunidad de quedar a un punto de la cima tras el empate de San Lorenzo. 
					</p>

				</div>
				
			</div>

				<!--
				No sabemos si lleva fotos aca!

				<div class="slider-small">
					<ul class="clearfix">
						<li><img class="thumb-mid" src="img/users/thumb/1.jpg"/></li>
						<li><img class="thumb-mid" src="img/users/thumb/1.jpg"/></li>
						<li><img class="thumb-mid" src="img/users/thumb/1.jpg"/></li>
					</ul>	
				</div>
			-->
		</div>
		<!-- END featured project module -->


		<!-- Current projects module -->
		<div class="mod grid_8 org-mod">
			<div class="mod-header">
				<h2>Organization list</h2>
			</div>
			<!-- talks -->
			<ul class="mod-content pet-loss-mod-list talks-list">
				<li class="clearfix">
					<img src="img/pet-loss/thumb/1.jpg" class="thumb-small side-img"/>
					<div class="content-description bg-txt ">
						<h3>We will mis you</h3>
						<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						<a href="#">View post</a>
					</div>
				</li>
				<li class="clearfix">
					<img src="img/projects/thumb/1.jpg" class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3>Forever</h3>
						<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						<a href="#">View post</a>
					</div>
				</li>
				<li class="clearfix">
					<img src="img/projects/thumb/1.jpg" class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3>Coco</h3>
						<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						<a href="#">View post</a>
					</div>
				</li>
				<li class="clearfix">
					<img src="img/projects/thumb/1.jpg" class="thumb-small side-img"/>
					<div class="content-description bg-txt">
						<h3>Coco</h3>
						<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						<a href="#">View post</a>
					</div>
				</li>
			</ul>
			<!-- END talks -->
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
</body>
</html>
