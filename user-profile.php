<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOProfiles.php";
	$p = new BOProfiles($_GET['u']);
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
		<div class="mod grid_12 profiles-mod nogrid-mod">
			<div class="mod-header">
				<h2><strong class="nickname"><?php echo $p->getNickname() ?></strong>About me</h2>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					<a href= <?php echo '"'.$p->getProfilePic().'"'; ?> ><img src=<?php echo '"'. $p->getThumb() .'"'; ?> class="thumb-mid"/></a>
					<h3><?php echo $p->getName() ?></h3>
					<span><?php echo $p->getLocation() ?></span>
				</div>
				<div class="bg-txt">
					<p><?php echo $p->getAbout() ?></p>
				</div>
				<div id="user-extra">
					<ul>
						<li><a href="#">Send me a message</a></li>
						<li><a href="#">My projects</a></li>
						<li><a href="#">My tributes</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- END about module -->

		<!-- my pets -->
		<div class="grid_5">
		<div class="mod  profiles-mod">
			<div class="mod-header">
				<h2>My Pets</h2>
			</div>
			<ul class="mod-content clearfix">
				<?php 
					if($p->getPets()) 
					{
						$pets = $p->getPets();
						$petProfiles = '';
						for($i = 0; $i < sizeof($pets); $i++)
						{


				?>
							<li class="pet-info">
								<a href=<?php echo '"'.$pets[$i]['ID_PET'].'"' ?>><img src=<?php echo '"'.$pets[$i]['THUMB'].'"'?> class="thumb-small"/></a>
								<h3><a href=<?php echo '"'.$pets[$i]['ID_PET'].'"' ?> > <?php echo $pets[$i]['NAME'] ?> </a></h3>
								<span><?php echo $pets[$i]['BREED'] ?></span>
							</li>
						
				<?php
						
						}//END FOR
					
					}//END IF 
				
				?>
			</ul>
		</div>
		<!-- END my pets -->

		<!-- news -->
		<div class="mod profiles-mod nogrid-mod" id="news-mod">
			<div class="mod-header">
				<h2>My Recent News</h2>
			</div>
			<ul class="mod-content clearfix">
				<li class="recent-news">
					<span>September 21, 2012</span>
					<p>El gobernador de San Juan arribó este mediodía a la Ciudad y ya <p>
				</li>

				<li class="recent-news">
					<span>September 21, 2012</span>
					<p>El gobernador de San Juan arribó este mediodía a la Ciudad y ya se encuentra alojado en el este mediodía a la Ciudad y ya se este mediodía a la Ciudad y ya s<p>
				</li>

				<li class="recent-news">
					<span>September 21, 2012</span>
					<p>El gobernador de San Juan arribó este mediodía a la Ciudad y ya se encuentra alojado en el este mediodía a la Ciudad y ya se este mediodía a la Ciudad y ya s<p>
				</li>
			</ul>
		</div>
		<!-- END news -->
		</div>
		<!-- END left -->


		<!-- pet profile -->
		<div class="mod grid_7 profiles-mod nogrid-mod ">
			<?php 
				if($p->getPets())
				{
			?>
					<div class="mod-header">
						<h2><strong class="nickname"><?php echo $pets[0]['NAME'] ?> </strong>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
						<div class="pic-caption pet-info">
							<a href=<?php echo '"'.$pets[0]['PIC'].'"'; ?> ><img src=<?php echo '"'.$pets[0]['THUMB'].'"'; ?> class="thumb-mid"/></a>
							<span><strong>Traits: </strong><?php echo $pets[0]['TRAITS'];?></span>
						</div>
						
						<div class="bg-txt corregir">
							<p><?php echo $pets[0]['STORY'];?></p>
						</div>
						
						<div class="slider-small">
							<ul class="clearfix">
								<li><img class="thumb-small" src="img/users/thumb/1.jpg"/></li>
								<li><img class="thumb-small" src="img/users/thumb/1.jpg"/></li>
								<li><img class="thumb-small" src="img/users/thumb/1.jpg"/></li>
							</ul>	
						</div>

						<div class='video'>
							
							<div class='wrapper-play'>
								<div class="play"></div>
								<img src="" class="thumb-big video-thumb"/>
							</div>

							<div class="video-last-caption">
								<h3>Hey! let me pass - <span>2:12</span></h3>
								<span><strong>By: </strong> Petter Putter</span>
							</div>
							
						</div>
					</div>
			<?php 
				}//END IF
			?>
	
		</div>
		<!-- END my pet profile -->

		<!-- user album -->
		<div class="mod grid_12 profiles-mod ">
			<div class="mod-header">
				<h2>My album</h2>
			</div>
			<ul class="grid-thumbs clearfix mod-content">
				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->

				<!-- user -->
				<li>
					<a href="#">
						<img src="img/users/thumb/1.jpg" class="thumb-mid"/>
					</a>
				</li>
				<!-- END user -->
			</ul>
		</div>
		<!-- END user album -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>


</div>
<!-- END wrapper-->
</body>
</html>
