<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOProfiles.php";
	$p = new BOProfiles($_GET['u']);
	//$_SESSION['current-profile'] = $_GET['u'];
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
				if($p->isOwn())
				{
					echo '<a href="#" class="btn btn-edit" id="edit-user-info">Edit</a>';	
				}
			?>	
			<div class="mod-header">
				<h2>
					<strong class="nickname">
						<?php 
							$nick = $p->getNickname();
							if(empty($nick))
								echo $p->getName();
							else
								echo $nick;
						?>
					</strong>About me
				</h2>
			</div>
			<div class="mod-content clearfix">
				<div class="pic-caption">
					<a href= <?php echo '"'.$p->getProfilePic().'"'; ?> ><img src=<?php echo '"'. $p->getThumb() .'"'; ?> class="thumb-mid"/></a>
					<h3><?php echo $p->getNameComp() ?></h3>
					<span><?php echo $p->getLocation() ?></span>
				</div>
				<div class="bg-txt">
					<p>
						<?php 
							$about = $p->getAbout();
							if(empty($about))
								echo 'The user has not entered any description yet';
							else
								echo $about;
						?>
					</p>
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
				<?php
					if($p->isOwn())
					{
						echo '<a href="#" class="btn btn-edit">Edit</a>';	
					}
				?>	
				<div class="mod-header">
					<h2>My Pets</h2>
				</div>
				<ul class="mod-content clearfix">
					<?php 
						$pets = $p->getPetList();
						if($pets) 
						{
							
							for($i = 0; $i < sizeof($pets); $i++)
							{

					?>
								<li class="pet-info">
									<a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <img src=<?php echo '"'.$pets[$i]['THUMB'].'"'?> class="thumb-small"/> </a>
									<h3><a href=<?php echo '"#'.$pets[$i]['ID_PET'].'"' ?> class="pet-link"> <?php echo $pets[$i]['NAME'] ?> </a></h3>
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
				<?php
					if($p->isOwn())
					{
						echo '<a href="#" class="btn btn-edit">Edit</a>';	
					}
				?>	
				<div class="mod-header">
					<h2>My Recent News</h2>
				</div>
				<ul class="mod-content clearfix">
					<?php 
						
						if($p->getNews())
						{
							$n = $p->getNews();
							
							for($i = 0; $i<sizeof($n); $i++)
							{
					?>
								<li class="recent-news">
									<span><?php echo $n[$i]['DATE']?></span>
									<p><?php echo $n[$i]['NEWS']; ?><p>
								</li>

					<?php 
							}//END FOR
						}//END IF
						else
						{
							echo '<li class="recent-news">The user does not have any update yet</li>';
						}
					?>
				</ul>
			</div>
			<!-- END news -->
		</div>
		<!-- END left -->


		<!-- pet profile -->
		<div id="pet-profile"class="mod grid_7 profiles-mod nogrid-mod ">
			<?php
				if($p->isOwn())
				{
					echo '<a href="#" class="btn btn-edit">Edit</a>';	
				}
			?>	

			<?php 
				if($p->getPetList())
				{	
					$pet = $p->getPet($pets[0]['ID_PET']);
			?>		
					<div class="mod-header">
						<h2><strong class="nickname"><?php echo $pet['NAME'] ?> </strong>My pet story</h2>
					</div>


					<div class="mod-content clearfix">
						
						<div class="pic-caption pet-info">
							<a href=<?php echo '"'.$pet['PIC'].'"'; ?> ><img src=<?php echo '"'.$pet['THUMB'].'"'; ?> class="thumb-mid"/></a>
							<ul>
								<li><span><strong>Breed: </strong><?php echo $pet['BREED'];?></span></li>
								<li><span><strong>Traits: </strong><?php echo $pet['TRAITS'];?></span></li>
							</ul>
						</div>
						
						<div class="bg-txt corregir">
							<p><?php echo $pet['STORY'];?></p>
						</div>
						
						<div class="slider-small">
							<?php
								if($pet['ALBUM_ID'])
								{
									$album = $p->getAlbum($pet['ALBUM_ID'])
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
								if($pet['VIDEO'])
								{
							?>
									<div class='wrapper-play'>
										<div class="play"></div>
										<img src=<?php echo '"'.$pets['VIDEO']['THUMB'].'"'; ?> class="thumb-big video-thumb"/>
									</div>

									<div class="video-last-caption">
										<h3><?php echo $pets['VIDEO']['TITLE'] ?><span>2:12</span></h3>
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
		<div class="mod grid_12 profiles-mod ">
			<?php
				if($p->isOwn())
				{
					echo '<a href="#" class="btn btn-edit">Edit</a>';	
				}
			?>	
			<div class="mod-header">
				<h2>My album</h2>
			</div>
			<?php
				$aId = $p->getAlbumId();
				if($aId)
				{
			?>
					<ul class="grid-thumbs clearfix mod-content">
			<?php
					$a = $p->getAlbum($aId);
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

	var editUser = byid('edit-user-info');
	editUser.onclick = function()
	{
		ajax('GET', 'ajax/getEditUser.php', printEditUser, null, true);
	}

	function printEdit(idModule, html)
	{		
		var cont = byid(idModule);
		cont.innerHTML = html;
		var scr = cont.getElementsByTagName('script');
		if(scr.length > 0)
		{
			for(var i = 0; i < scr.length; i++)
			{
				eval(scr[i].innerHTML);
			}
		}
	}

	function printEditUser()
	{
		printEdit('user-about', this.responseText);
	}


</script>
</body>
</html>
