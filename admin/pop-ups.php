<?php 
session_start();
include 'php/functions.php';
chkadmin();

include_once "../php/classes/BOPopups.php";
$pop = new BOPopups;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pet Magick</title>

		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/layout.css" type="text/css" />

		<script src="../js/jquery.js"></script> 
	 	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	<!--	<script type="text/javascript" src="bootstrap/js/lib.js"></script> -->



<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</head>
<body>
<div class="container-fluid">

	<?php
		include_once("templates/header.php");
	?>
	
	<div class="well span7  " id="pop-upsModule">
		<div class="tabbable"> 
			<ul class="nav nav-tabs">
				<li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'profile' || !isset($_GET['tab'])) echo "active"; ?>><a href="#profiles" data-toggle="tab">Profiles</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'antics') echo "active"; ?>><a href="#antics" data-toggle="tab" >Animal antics</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'vet') echo "active"; ?>><a href="#vet" data-toggle="tab">Vet talk</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'projects') echo "active"; ?>><a href="#projects" data-toggle="tab">Projects</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'organizations') echo "active"; ?>><a href="#organizations" data-toggle="tab">Organizations</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'petloss') echo "active"; ?>><a href="#petloss" data-toggle="tab">Pet loss</a></li>
			<!--    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'forum') echo "active"; ?>><a href="#forum" data-toggle="tab">Forum</a></li>
			    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'blog') echo "active"; ?>><a href="#blog" data-toggle="tab">Blog</a></li> -->
			</ul>
		 	
		 	<div class="tab-content">
			  
			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'profiles' || !isset($_GET['tab'])) echo "active"; ?>" id="profiles">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="profiles_id" >
				    	<label><b><small>Enter a text about Profiles section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("profiles") ?></textarea><br>
				    	<input type="hidden" value="profiles" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('profiles_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'antics') echo "active"; ?>" id="antics">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post"  id="antics_id">
				      	<label><b><small>Enter a text about Animal antics section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("antics") ?></textarea><br>
				    	<input type="hidden" value="antics" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('antics_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'vet') echo "active"; ?>" id="vet">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="vet_id">
				      	<label><b><small>Enter a text about Vet talk section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("vet") ?></textarea><br>
				    	<input type="hidden" value="vet" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('vet_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'projects') echo "active"; ?>" id="projects">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="projects_id">
				      	<label><b><small>Enter a text about Projects section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("projects") ?></textarea><br>
				    	<input type="hidden" value="projects" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('projects_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'organizations') echo "active"; ?>" id="organizations">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="organizations_id">
				      	<label><b><small>Enter a text about Organizations section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("organizations") ?></textarea><br>
				    	<input type="hidden" value="organizations" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('organizations_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'petloss') echo "active"; ?>" id="petloss">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="petloss_id" >
				      	<label><b><small>Enter a text about Pet loss section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("petloss") ?></textarea><br>
				    	<input type="hidden" value="petloss" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('petloss_id').submit(); return false;" >Save</a>
			    	 </form>
			    </div>

		<!--	    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'forum') echo "active"; ?>" id="forum">
			    	<form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="forum_id" >
				      	<label><b><small>Enter a text about Forum section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("forum") ?></textarea><br>
				    	<input type="hidden" value="forum" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" class="save" onclick="document.getElementById('forum_id').submit(); return false;">Save</a>
				     </form>
			    </div>

			    <div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'blog') echo "active"; ?>" id="blog">
				    <form action="http://www.petmagick.com/admin/php/texts.php" method="post" id="blog_id">
				      	<label><b><small>Enter a text about Blog section</small></b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"><?php echo $pop->getPopUps("blog") ?></textarea><br>
				    	<input type="hidden" value="blog" name="section" />
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('blog_id').submit(); return false;" >Save</a>
				    </form>
			    </div> -->
            </div>
		</div>
    </div>

    
</div>



</body>
</html>

