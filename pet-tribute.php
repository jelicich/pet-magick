<?php 
	session_start();
	//session_destroy();
	//var_dump($_SESSION);
	include_once 'php/classes/BOTributes.php';
	$t = new BOTributes;
	$a = $t->getTribute($_GET['t']);
	
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
		
		<!-- about module -->
		<div class="mod grid_12 pet-loss-mod nogrid-mod">
			<div class="mod-header">
				<h2><?php echo $a[0]['TITLE']; ?></h2>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					
					<a href=<?php echo '"'.$a[0]['PIC'] .'"' ?>><img src=<?php echo '"'.$a[0]['THUMB'].'"' ?> class="thumb-mid"/></a>
					
					<h3><?php echo $a[0]['NAME']; ?></h3>
					<ul>
						<li>Breed: <?php echo $a[0]['BREED']?></li> 
						<li>Birth: <?php echo $a[0]['SINCE'] ?></li>
						<li>Gone: <?php echo $a[0]['THRU'] ?></li>
					</ul>
				</div>
				
				<div class="bg-txt txt-wider">
					<p><?php echo $a[0]['CONTENT'] ?></p>
				</div>

				<a href=<?php echo '"user-profile.php?u='. $a[0]['USER_ID'] .'"';?> id='visit-member'><span>View member profile >></span></a> <!-- provisorio -->
				
			</div>
		</div>
		<!-- END about module -->

		

		<!-- Current projects module -->
		<div class="mod grid_12 pet-loss-mod">
			<div class="mod-header">
				<h2>Support mesagges</h2>

				<div id='what' class='ask-qa'> <!-- invertir clase y id aca -->
					<a href="#"><p>Leave your coment</p></a>
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
s
						</div>
						<div class=' arrow-top'></div>
					</div>
				</div>
			</div>

			<!-- talks -->
			<ul class="mod-content pet-loss-mod-list talks-list">
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
		<!-- END Current projects module -->

		

	</div>
	<!-- END site content -->
	
	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->
</body>
</html>
