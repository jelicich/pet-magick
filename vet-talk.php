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
		
		<!-- vet talk module -->
		<div class="mod grid_9 vet-talk-mod">
			<div class="mod-header">
				<h2>Flea infestation - First bla</h2>
			</div>
			<div class="clearfix mod-content">
				<div><!-- scrolleable -->
					
					<p class="vet-talk-article clearfix"> 
						<a href="#" class="vet-talk-img">
							<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
						</a>
						El 17 de abril de 2012 se anunció la expropiación de la mayoría de las acciones. Ahora el ministro de Industria, Energía y Turismo, José Manuel Soria; el presidente de la Caixabank, Isidro Fainé, y un equipo de directivos de Repsol se reunieron con Kicillof y Zannini en Buenos Aires.<br/><br/>

						También estuvieron presentes en el encuentro, el presidente de YPF Miguel Galuccio, el director general de negocios de Repsol Nemesio Fernández Cuesta, y el Embajador argentino en España, Don Carlos Bettini.

						Según informaron desde el Palacio de Hacienda en un comunicado, tal principio de acuerdo implicará fijar el monto de la compensación y su pago con activos líquidos y que ambas partes desistirán de las acciones legales en curso.


						También estuvieron presentes en el encuentro, el presidente de YPF Miguel Galuccio, el director general de negocios de Repsol Nemesio Fernández Cuesta, y el Embajador argentino en España, Don Carlos Bettini.<br/><br/>

						Según informaron desde el Palacio de Hacienda en un comunicado, tal principio de acuerdo implicará fijar el monto de la compensación y su pago con activos líquidos y que ambas partes desistirán de las acciones legales en curso.

						Según informaron desde el Palacio de Hacienda en un comunicado, tal principio de acuerdo implicará fijar el monto de la compensación y su pago con activos líquidos y que ambas partes desistirán de las acciones legales en curso.
						
					</p>
					<ul class="vet-talk-author">
						<li><strong>Autor</strong></li>
						<li><i>Fecha</i></li>
					</ul>

				</div>
			</div>
		</div>
		<!-- END vet talk module -->

		<!-- ads -->
		<div class="grid_3 asd" >
		</div>

		<div class="grid_3 asd" >
		</div>
		<!-- END ads -->

		<!-- talks module -->
		<div class="mod grid_12 vet-talk-mod">
			<div class="mod-header">
				<ul class="clearfix mod-menu">
					<li><a href="#" class="active">Dog</a></li>
					<li><a href="#">Cat</a></li>
					<li><a href="#">Bird</a></li>
					<li><a href="#">Rabbit</a></li>
					<li><a href="#">Ferret</a></li>
					<li><a href="#">Others</a></li>
				</ul>
			</div>
			<!-- talks -->
			<ul class="mod-content pet-loss-mod-list spacer10">
				<li class="clearfix">
					<img src="img/pet-loss/thumb/1.jpg" class="thumb-small side-img"/>
					<div class="content-description bg-txt">
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
		<!-- END talks module -->


		<!-- q&a -->
		<div class="mod grid_12 vet-talk-mod">
			<div class="mod-header clearfix">
				<h2>Question time?</h2>
				
				<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
					<a href="#"><p>Have you got any question ?</p></a>
					<div class='active'>
						<div id='pop-up' class='mod grid_4 '>

							<form class="form" >  

							    <p class="text">  
							        <textarea placeholder="Your question..." ></textarea>  
							    </p>  

							    <p class="submit">  
							        <input type="submit" value="Submit" />  
							    </p>  

						    </form> 

						</div>
						<div class=' arrow-top'></div>
					</div>
				</div>
			</div>

			<ul class="mod-content pet-loss-mod-list qa-list">
				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						<li class="vet-a">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						
					</ul>
				</li>
				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
						<li class="vet-a">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld sñfdk sñkdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
					</ul>
				</li>
				<li>
					<ul>
						<li class="vet-q">
							<p>asdlk aslkd lakdlakd dsk skdsld skdk dslkdkdf kfdlfdk fdfkdlfk ldkf dfñsdfkwoer sdl spdlfld fsñfdk sñf</p>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- END q&a -->
		

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->
</body>
</html>
