<?php 
session_start();

include 'php/functions.php';
chkadmin();
 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lte IE 8]>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="utf-8" http-equiv="encoding">

		<title>Pet Magick</title>

		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/layout.css" type="text/css" />

		<script src="../js/jquery.js"></script> 
	 	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	    <script type="text/javascript" src="../js/lib.js"></script>
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
	


	<div class="well span7" id="ads-module" style="width:800px">

		<iframe id="iframe-ads" src="ledads/admin.php"></iframe>
		
<!--
		<div class="tabbable"> 
			<ul class="nav nav-tabs">
				<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
			    <li><a href="#antics" data-toggle="tab">Animal antics</a></li>
			    <li><a href="#vet" data-toggle="tab">Vet talk</a></li>
			    <li><a href="#projects" data-toggle="tab">Projects</a></li>
			    <li><a href="#organiztions" data-toggle="tab">Organiztions</a></li>
			    <li><a href="#forum" data-toggle="tab">Forum</a></li>
			    <li><a href="#blog" data-toggle="tab">Blog</a></li>
			</ul>
		 	
		 	<div class="tab-content">
			  
			    <div class="tab-pane active" id="profile">

			    	<?php

					echo '<a href="#'.$_SESSION['id'].'" class="btn btn-edit btn-info btn-mini" id="save-admin">Save</a>
						  <a href="#'.$_SESSION['id'].'" class="btn btn-cancel btn-info btn-mini" id="cancel-admin">Cancel</a>';	
					?>

			    	<div id='admin'></div>
		    		<div id='imgContainer'></div>

					<iframe name="iframe_IE" src="" style="display: none"></iframe> 

					<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

					</form>
			    	<!- -<form action="php/texts.php" method="post" id="profile_id" >
				    	
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('profile_id').submit(); return false;" >Save</a>
			    	</form> 
			    </div>

			    <div class="tab-pane" id="antics">
			    	<form action="php/texts.php" method="post"  id="antics_id">
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('antics_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="vet">
			    	<form action="php/texts.php" method="post" id="vet_id">
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('vet_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="projects">
			    	<form action="php/texts.php" method="post" id="projects_id">
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('projects_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="organizations">
			    	<form action="php/texts.php" method="post" id="organizations_id">
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('organizations_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="forum">
			    	<form action="php/texts.php" method="post" id="forum_id" >
				    	<a href="#" class="save btn btn-small btn-info" class="save" onclick="document.getElementById('forum_id').submit(); return false;">Save</a>
				     </form>
			    </div>

			    <div class="tab-pane" id="blog">
				    <form action="php/texts.php" method="post" id="blog_id">
				    	<a href="#" class="save btn btn-small btn-info" onclick="document.getElementById('blog_id').submit(); return false;" >Save</a>
				    </form>
			    </div>
            </div>
		</div>
		-->
    </div>
    
</div>


<script type="text/javascript">

</script>

</body>
</html>

