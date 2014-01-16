<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	
	include_once "php/classes/BOUsers.php";
	include_once "php/classes/BONews.php";
	include_once "php/classes/BOPets.php";
	
	
	$u = new BOUsers;
	$n = new BONews;
	$p = new BOPets;
	

	$u->getUserData($_GET['u']);
	$u->checklogin();
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
			<div class="mod grid_12 profiles-mod nogrid-mod" id="user-about">
				<?php 
					include_once 'templates/userAbout.php'; 
				?>
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

						$pets = $p->getPetList($_GET['u']);
						if($pets) 
						{
							
							for($i = 0; $i < sizeof($pets); $i++)
							{

					?>
								<li class="pet-info">
									<a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <img src=<?php echo '"'.$pets[$i]['THUMB'].'"'?> class="thumb-small"/> </a>
									<h3><a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <?php echo $pets[$i]['NAME'] ?> </a></h3>
									<span><?php echo $pets[$i]['BREED'] ?></span>
					<?php
										if($u->isOwn())
										{
											echo '<a href="#'.$pets[$i]['ID_PET'].'" class="btn edit-pet-profile">Edit</a><a href="#" class="btn btn-danger">Delete</a>';	
										}
					?>	
								</li>
							
					<?php
							
							}//END FOR
						
						}//END IF 
					
					?>
				</ul>

				<script type="text/javascript">
					editPetProfile();
				</script>
			</div>
			<!-- END my pets -->


			<!-- news -->
			<?php 
				include_once 'templates/userNews.php'; 
			?>
			<!-- END news -->
		</div>
		<!-- END left -->


		<!-- pet profile -->


		<div id="pet-profile"class="mod grid_7 profiles-mod nogrid-mod ">
			<?php
				/*
				if($u->isOwn())
				{
					echo '<a href="#" class="btn btn-edit">Edit</a>';	
				}
				*/
			?>	

			<?php 
				if($p->getPetList($_GET['u']))
				{	
					$p->getPetData($pets[0]['ID_PET']);
					//$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
					<div class="mod-header">
						<h2><strong class="nickname"><?php echo $p->getName(); ?> </strong>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
						<div class="pic-caption pet-info">
							<a href=<?php echo '"'.$p->getPic().'"'; ?> ><img src=<?php echo '"'.$p->getThumb().'"'; ?> class="thumb-mid"/></a>
							<ul>
								<li><span><strong>Breed: </strong><?php echo $p->getBreed();?></span></li>
								<li><span><strong>Traits: </strong><?php echo $p->getTraits();?></span></li>
							</ul>
						</div>
						
						<div class="bg-txt corregir">
							<p><?php echo $p->getStory();?></p>
						</div>
						
						<div class="slider-small">
							<?php
								if($p->getAlbumId())
								{
									$album = $p->getAlbum($p->getAlbumId());
							?>
									<ul class="clearfix">
							<?php

									for($i=0;$i<sizeof($album);$i++)
									{
							?>
									
										<li><a href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> ><img class="thumb-small" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> /></a></li>
										
							<?php
									}//end for
							?>
									</ul>
							<?php
								}//END IF
							?>
						</div>

						<div class='video'>
							<?php
								$v = $p->getVideo();
								if($v)
								{
							?>
									<div class='wrapper-play'>
										<div class="play"></div>
										<img src=<?php echo '"'.$v['THUMBNAIL'].'"'; ?> class="thumb-big video-thumb"/>
									</div>

									<div class="video-last-caption">
										<h3><?php echo $v['TITLE'] ?><span>2:12</span></h3>
										<!--<span><strong>By: </strong> Petter Putter</span>-->
									</div>
							<?php
								} //end if videos
							?>
						</div>
					</div>
			<?php 
				}//END IF pets
			?>
	
		</div>
		<!-- END my pet profile -->

		<!-- user album -->
		<div id='user-album' class="mod grid_12 profiles-mod">
			<?php
				if($u->isOwn())
				{
					echo '<a href="#" class="btn btn-edit">Edit</a>';	
				}
			?>	
			<div class="mod-header">
				<h2>My album</h2>
			</div>
			<?php
				$aId = $u->getAlbumId();
				if($aId)
				{
			?>
					<ul class="grid-thumbs clearfix mod-content">
			<?php
					$a = $u->getAlbum($aId);
					for($i = 0; $i<sizeof($a); $i++)
					{
			?>
						<li><a href=<?php echo '"'.$a[$i]['PIC'].'"'; ?> ><img class="thumb-mid" src=<?php echo '"'.$a[$i]['THUMB'].'"';?> /></a></li>
			<?php
					}//END FOR
			?>
					</ul>
			<?php
				}//END IF
			?>
		</div>
		<!-- END user album -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>


</div>
<!-- END wrapper-->

<script type="text/javascript">
	profile();
	news();
	//editUserProfile();
</script>

</body>
</html>
