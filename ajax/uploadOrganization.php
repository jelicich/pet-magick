<?php

session_start();
include_once "../php/classes/BOOrganizations.php";
include_once "../php/classes/BOPics.php";

$org = new BOOrganizations;
$pics = new BOPics;


function createQuery($query, $path, $class){

	$id_last_insert = $class->upload($query, $path);
	//var_dump($id_last_insert);
	//le agrego a post la imagen;
	$_POST['pic']=$id_last_insert;
	//echo $class->getErrors();
}//create query

if(isset($_FILES['file'])){ // normalWay();

	$t = count($_FILES['file']['name']); 

	for($i = 0; $i < $t; $i++){

		$query['file'] = $_FILES['file']['tmp_name'][$i];
		$query['fileName'] = $_FILES['file']['name'][$i];
		$query['fileSize'] = $_FILES['file']['size'][$i];
		$query['fileType'] = $_FILES['file']['type'][$i];
		$query['caption']  = '';

		$obj = $pics; 
		$path = '../img/organizations/';

		createQuery($query, $path, $obj);

	}// end for
}else{ // fallBack();
	
	foreach ($_FILES as $key => $eachFile) 
	{
				//$index = strpos($key, "_");
		  		//$index++;
		  		//$p = substr($key, $index);

				$query['file'] = $eachFile['tmp_name'];
				$query['fileName'] = $eachFile['name'];
				$query['fileSize'] =$eachFile['size'];
				$query['fileType'] = $eachFile['type'];
				$query['caption'] = ''; 

				$obj = $pics; 
				$path = '../img/organizations/';
		
				createQuery($query, $path, $obj);$counter++;
	}// end foreach
}// end else


$dato = array(

	'name' => $_POST['name'],
	'description' => $_POST['description'],
	'user_id' => $_SESSION['id'],
	'pic_id' => $_POST['pic']
);


$org->insertOrganizations($dato);




?>
								<?php
									echo '<a href="#'.$_SESSION['id'].'" class="btn btn-edit" id="save-edit-user">Save</a>
									<a href="#'.$_SESSION['id'].'" class="btn btn-cancel" id="cancel-edit-user">Cancel</a>';	
									$list = $org->getOrgListByUser($_SESSION['id']);
									if($list)
									{
										for($i=0; $i<sizeof($list); $i++)
										{
								?>
										<li class="vet-q clearfix">
											<img src=<?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
											<div class="content-description bg-txt">
												<h3><?php echo $list[$i]['NAME']?></h3>
												<p><?php echo $list[$i]['DESCRIPTION'] //hacerle un substr?></p>
												<a href=<?php echo '"'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger">Delete</a>
											</div>
										</li>
								<?php
										}//end for
									}//end if
								?>
								<div id='organization'></div>
								<div id='imgContainer'></div>

								<iframe name="iframe_IE" src="" style="display: none"></iframe> 

								<form action="ajax/insertar.php" method="post" enctype="multipart/form-data" id="form-id" target="iframe_IE">

									<input type='text' class = 'form-element' name='name' />
									<textarea class = 'form-element' name='description'></textarea>
									<script type="text/javascript">
										imgVideoUploader('profile', 'organization'); 
									</script>

								</form>