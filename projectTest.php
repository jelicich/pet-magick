<!doctype html>

<!--[if lte IE 8]>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<![endif]-->

<html>
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<style>

#imgContainer{
	
	width: 200px;
	height: 200px;
	border: 2px solid gray;
}

</style>


</head>
<body>
<?php
	session_start();
	echo '<a href="#'.$_SESSION['id'].'" class="btn btn-edit" id="save-edit-user">Save</a>
		  <a href="#'.$_SESSION['id'].'" class="btn btn-cancel" id="cancel-edit-user">Cancel</a>';	
?>
	<div id='project'></div>
	<div id='imgContainer'></div>

	<iframe name="iframe_IE" src="" style="display: none"></iframe> 

	<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE"><!-- insertar ???? -->

		  <input type='text' class = 'form-element' name='title' />
		  <textarea class = 'form-element' name='description'></textarea>
		  <!--<p id="upload-status"></p>
		  <pre id="result"></pre>-->

	</form>


<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript">

	imgVideoUploader('album', 'project'); 

</script>

</body>
</html>
