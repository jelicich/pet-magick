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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pet Magick</title>

		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">

		<script src="../js/jquery.js"></script> 
	 	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	<!--	<script type="text/javascript" src="bootstrap/js/lib.js"></script> -->
</head>


<!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
	
	#pop-upsModule{
		margin-top: 100px;
	}
</style>

</head>
<body>
<div class="container-fluid">

	<?php
		include_once("templates/header.php");
	?>
	
	<div class="well" id="pop-upsModule">
		<div class="tabbable"> 
			<ul class="nav nav-tabs">
				<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
			    <li><a href="#antics" data-toggle="tab">Animal antics</a></li>
			    <li><a href="#vet" data-toggle="tab">Vet talk</a></li>
			    <li><a href="#projects" data-toggle="tab">Projects</a></li>
			    <li><a href="#organiztions" data-toggle="tab">Organiztions</a></li>
			    <li><a href="#petloss" data-toggle="tab">Pet loss</a></li>
			    <li><a href="#forum" data-toggle="tab">Forum</a></li>
			    <li><a href="#blog" data-toggle="tab">Blog</a></li>
			</ul>
		 	
		 	<div class="tab-content">
			  
			    <div class="tab-pane active" id="profile">
			    	<form action="php/texts.php" method="post" id="profile_id" >
				    	<label><b>Enter a text about Profile section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('profile_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="antics">
			    	<form action="php/texts.php" method="post"  id="antics_id">
				      	<label><b>Enter a text about Animal antics section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('antics_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="vet">
			    	<form action="php/texts.php" method="post" id="vet_id">
				      	<label><b>Enter a text about Vet talk section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('vet_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="projects">
			    	<form action="php/texts.php" method="post" id="projects_id">
				      	<label><b>Enter a text about Projects section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('projects_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="organizations">
			    	<form action="php/texts.php" method="post" id="organizations_id">
				      	<label><b>Enter a text about Organiztions section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('organizations_id').submit(); return false;" >Save</a>
			    	</form>
			    </div>

			    <div class="tab-pane" id="petloss">
			    	<form action="php/texts.php" method="post" id="petloss_id" >
				      	<label><b>Enter a text about Pet loss section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('petloss_id').submit(); return false;" >Save</a>
			    	 </form>
			    </div>

			    <div class="tab-pane" id="forum">
			    	<form action="php/texts.php" method="post" id="forum_id" >
				      	<label><b>Enter a text about Forum section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" class="save" onclick="document.getElementById('forum_id').submit(); return false;">Save</a>
				     </form>
			    </div>

			    <div class="tab-pane" id="blog">
				    <form action="php/texts.php" method="post" id="blog_id">
				      	<label><b>Enter a text about Blog section</b></label>
				    	<textarea cols='50' rows='10' class="texts" name="content"></textarea><br>
				    	<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('blog_id').submit(); return false;" >Save</a>
				    </form>
			    </div>
            </div>
		</div>
    </div>

    
</div>


<script type="text/javascript">
	/*
	var save = $(".save");

	save.click(function(event){
  			
  			event.preventDefault();
  			alert('hola');

	});
	*/
</script>

</body>
</html>

