<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	
	include_once "php/classes/BOUsers.php";
	include_once "php/classes/BONews.php";
	include_once "php/classes/BOPets.php";
	include_once "php/classes/BOAnimalCategories.php";
	
	
	$u = new BOUsers;
	$n = new BONews;
	$p = new BOPets;
	$ac = new BOAnimalCategories;

	$u->getUserData($_GET['u']);
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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<?php
	//imprimo lo necesario para el datepicker
	if($u->isOwn())
	{
		echo 
		'<link rel="stylesheet" type="text/css" href="datepicker/css/ui-lightness/datepicker.css" />
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.10.3.custom.min.js"></script>
		';
	}
?>

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
			<div class="mod  profiles-mod" id="pet-list">
				
				<?php
					$pets = $p->getPetList($_GET['u']);
					include_once 'templates/petList.php';
				?>

				
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


		<div id="pet-profile" class="mod grid_7 profiles-mod nogrid-mod ">


			<?php 
				if($p->getPetList($_GET['u']))
				{	
					$p->getPetData($pets[0]['ID_PET']);
					include_once 'templates/petProfile.php';
			?>		
					
			<?php 
				}//END IF pets
			?>
	
		</div>
		<!-- END my pet profile -->

		<!-- user album -->
		<div id='user-album' class="mod grid_12 profiles-mod clearfix">
			<?php
				include_once 'templates/userAlbum.php'; 
			?>
		</div>
		<!-- END user album -->

		<?php
		//OPCIONES PARA SECCIONES EXTERNAS
			if($u->isOwn())
			{
		?>
				<div id="admin" class="mod grid_12 clearfix profiles-mod">

					<div class="mod-header">
						<h2>Admin</h2>
					</div>
					
					<div class="mod-content clearfix">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#organizations" data-toggle="tab">Organizations</a></li>
							<li><a href="#projects" data-toggle="tab">Projects</a></li>
						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							<li><a href="#vtarticles" data-toggle="tab">Vet Talk Articles</a></li>
							<li><a href="#vtquestions" data-toggle="tab">Vet Talk Questions</a></li>
						<?php
						}
						?>
						</ul><!-- end navtabs -->


						<div class="tab-content">
							<div class="tab-pane active" id="organizations">Orgs</div>
							<div class="tab-pane" id="projects">Proj</div>
							
						<?php
						if($_SESSION['rank'] == 1)
						{
						?>
							<div class="tab-pane" id="vtarticles">Arts</div>
							<div class="tab-pane" id="vtquestions">
								<?php
									include_once "php/classes/BOQuestions.php";
									$ques = new BOQuestions;
									$aq = $ques->getNewQuestions();
								?>
								<ul class="pet-loss-mod-list qa-list" id="comments-wrapper">
									<?php 
										for($i = 0; $i<sizeof($aq); $i++)
										{						
									?>

											<li class="clearfix">
												<ul>
													<li class="vet-q clearfix">
														<a href=<?php echo '"user-profile.php?u='.$aq[$i]['Users']['ID_USER'] .'"' ?> ><img src=<?php echo '"'.$aq[$i]['Users']['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/></a>
														<div class="content-description bg-txt">
															<h3><a href=<?php echo '"user-profile.php?u='.$aq[$i]['Users']['ID_USER'] .'"' ?>><?php echo $aq[$i]['Users']['NAME'].' '.$aq[$i]['Users']['LASTNAME'] ?></a></h3>
															<p><?php echo $aq[$i]['QUESTION']?></p>
															<span><?php echo $aq[$i]['DATE']?></span>
														</div>
													</li>
													<li class="vet-a clearfix">
														<p>
															<textarea></textarea>
															<input type="hidden" value=<?php echo '"'.$aq[$i]['ID_QUESTION'].'"'?>/>
															<input type="button" value="Submit" class="submit-answer"/>
														</p>
													</li>
												</ul>
											</li>

									<?php 
										}//end for
									?>

								</ul>
							</div>
						<?php
						}
						?>
						</div><!-- end tab content -->

					</div><!-- end mod contet -->
					
				</div><!-- end admin -->
		<?php 
			}
		?>
	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>


</div>
<!-- END wrapper-->

<script type="text/javascript">
	//profile();
	news();
	//deletePet();
	//addPet();
	vetTalkAnswer();
	function vetTalkAnswer()
	{
		var btns = document.querySelectorAll('.submit-answer');
		for(var i = 0; i<btns.length; i++)
		{
			btns[i].onclick = function()
			{
				id = this.previousElementSibling;
				txt = id.previousElementSibling;
				//publica
				tmpLi = this.parentNode.parentNode.parentNode.parentNode;
				var vars= 'id='+id.value+'&a='+txt.value;
				ajax('POST', 'ajax/answerQuestion.php', removeQuestion, vars, true)
			}
		}

		function removeQuestion()
		{
			var html = this.responseText;
			if(html == '' || html == undefined)
			{
				tmpLi.parentNode.removeChild(tmpLi);
			}
			else
			{
				var e = document.createElement(p);
				e.innerHTML = html;
				tmpLi.appendChild(e);
			}
		}

	}
	
	$('.nav-tabs a').click(function (e)
	{
		e.preventDefault();
		$(this).tab('show');
	});
</script>

</body>
</html>
