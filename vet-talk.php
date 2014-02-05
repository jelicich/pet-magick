<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOVettalk.php";
	include_once "php/classes/BOPics.php";
	include_once "php/classes/BOQuestions.php";

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

		<div class="mod grid_9 vet-talk-mod" id='mainArticle'>
		<?php 
			include_once 'templates/vetTalkArticleModule.php'; 
		?>
		</div>
		<!-- END vet talk module -->

		<!-- ads -->
		<div class="grid_3 asd" >
		</div>

		<div class="grid_3 asd" >
		</div>
		<!-- END ads -->

		<!-- talks module -->

		<?php 
			include_once 'templates/vetTalkListModule.php'; 
		?>
		<!-- END talks module -->


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
</script>

</body>
</html>
