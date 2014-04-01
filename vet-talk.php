<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOVettalk.php";
	include_once "php/classes/BOPics.php";
	include_once "php/classes/BOQuestions.php";
	include_once "php/classes/BOPopups.php";
	include_once "php/classes/BOLocation.php";
	$pop = new BOPopups;
	$vetTalk = new BOVettalk;
	$ques = new BOQuestions;
	$pics = new BOPics;

	$aq = $ques->getQuestions();


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

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script>  

<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">
	
	<div class="grid_12">
		<div id='what' >
			<a href="#"><p>How does Project board work ?</p></a>
			<div class='active'>
				<div id='pop-up' class='mod grid_4 '>

					<p> 
						<?php echo htmlspecialchars($pop->getPopUps("vet")); ?>
					</p>

				</div>
				<div class=' arrow-top'></div>
			</div>
		</div>
	</div>
		<!-- vet talk module -->

		<div class="grid_12">
		<?php 
			include_once 'templates/vetTalkArticleModule.php'; 
		?>

		</div>
		<!-- END vet talk module -->

		<!-- talks module -->
		<?php 
			include_once 'templates/vetTalkListModule.php'; 
		?>
		<!-- END talks module -->

		<!-- asd -->
		<div class="grid_4 publi-org" >
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div>

		<div class="grid_4 publi-org" >
		</div>
		<!-- END asd -->

		


		<!-- q&a -->
		<?php 
			include_once 'templates/vetTalkMsgModule.php'; 
		?>
		<!-- END q&a -->
		

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<script type="text/javascript">
	selectedFromList('mainArticle', 'ajax/getSelectedArticle.php?p=');
	comments('postQuestion');
	start_scroll('scrollable-list', false);
</script>

</body>
</html>
