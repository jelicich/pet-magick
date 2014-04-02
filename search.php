<?php 
	session_start();
	$_SESSION['token'] = sha1(uniqid()); 

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
<link rel="stylesheet" href="css/videos.css" type="text/css" />
<link type="text/css" href="video/skin/jplayer.blue.monday.css" rel="stylesheet" />
<!-- <script src="http://code.jquery.com/jquery.js"></script>
<script src="js/jquery.js"></script> 
 <script type="text/javascript" src="js/bootstrap.js"></script>  -->
 <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>


<!--[if lte IE 8]> <link rel="stylesheet" href="css/ie/ie_index_8.css" type="text/css" /> <![endif]-->
<!--[if IE 7]> <link rel="stylesheet" href="css/ie/ie_index_7.css" type="text/css" /> <![endif]-->

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<div id="wrapper">

	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">
		<div class="grid_12 search-filter clearfix">
			<span>Filters: </span>
			<ul class="clearfix">
				<li <?php if($_GET['tar'] == 'us') echo 'class="current-search"'?> ><a href="<?php echo 'search.php?q='.$_GET['q'].'&tar=us&active=10' ?>">Users</a></li>
				<li <?php if($_GET['tar'] == 'pe') echo 'class="current-search"'?> ><a href="<?php echo 'search.php?q='.$_GET['q'].'&tar=pe&active=10' ?>">Pets</a></li>
				<li <?php if($_GET['tar'] == 'or') echo 'class="current-search"'?> ><a href="<?php echo 'search.php?q='.$_GET['q'].'&tar=or&active=10' ?>">Organizations</a></li>
				<li <?php if($_GET['tar'] == 'pr') echo 'class="current-search"'?> ><a href="<?php echo 'search.php?q='.$_GET['q'].'&tar=pr&active=10' ?>">Projects</a></li>
			</ul>
		</div>
		<!-- search result-->
		<div id="profiles-mod" class='grid_12 profiles-mod mod'>
			<div class="mod-header">
				<h2>
					<?php 
					switch ($_GET['tar']) {
						case 'us':
							echo 'Users';
							$file = 'ajax/searchUsers.php';
							break;

						case 'pe':
							echo 'Pets';
							$file = 'ajax/searchPets.php';
							break;

						case 'or':
							echo 'Organizations';
							$file = 'ajax/searchOrganizations.php';
							break;
						
						case 'pr':
							echo 'Projects';
							$file = 'ajax/searchProjects.php';
							break;

						default:
							echo 'Results';
							$file = 'ajax/searchUsers.php';
							break;
					}?>
					 matching your search <i><?php echo htmlspecialchars($_GET['q']); ?></i>
				</h2>
			</div>
			<div class="scrollable-module">
				
				<?php
					if(empty($_GET['q']) || !isset($_GET['q']) || empty($_GET['tar']) || !isset($_GET['tar']) )
					{
						echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
					}
					else
					{
						
						switch ($_GET['tar']) {
							
							//USERS
							case 'us':
								include 'php/classes/BOUsers.php';
								$u = new BOUsers;
								$r = $u->searchUsers($_GET['q'],0,28);

								$totalRec = $u->totalRecords($_GET['q']);
								$totalPag = ceil($totalRec/28);
								
								
								if($r)
								{
									echo "<ul class='grid-thumbs clearfix' id='ModulesByPet'>";
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Pics']))
										{
											$thumb = 'img/users/thumb/'.$r[$i]['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/users/thumb/default.jpg';	
										}
										?>
											<li>
												<a href=<?php echo "user-profile.php?u=".$r[$i]['ID_USER'].'&active=10'; ?> >
													<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
														<dt><?php echo htmlspecialchars($r[$i]['NAME']." ".$r[$i]['LASTNAME']); ?> </dt>
														<dd><?php echo  htmlspecialchars($r[$i]['Cities']['City'].", ".$r[$i]['Countries']['Country']); ?></dd>
													<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
													</dl>
												</a>
											</li>
										<?php 
									}
									echo "</ul>";
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
								break;

							//PETS
							case 'pe':
								include 'php/classes/BOPets.php';
								$p = new BOPets;
								$r = $p->searchPets($_GET['q'], 0);

								$totalRec = $p->totalRecords($_GET['q']);
								$totalPag = ceil($totalRec/28);
								
								if($r)
								{
									echo "<ul class='grid-thumbs clearfix' id='ModulesByPet'>";
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Pics']))
										{
											$thumb = 'img/pets/thumb/'.$r[$i]['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/pets/thumb/default.jpg';	
										}
										?>
											<li>
												<a href=<?php echo "user-profile.php?u=".$r[$i]['Users']['ID_USER'].'&p='.$r[$i]['ID_PET'].'&active=10'; ?> >
													<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
														<dt><?php echo htmlspecialchars($r[$i]['NAME']." | ".$r[$i]['AnimalCategories']['NAME']); ?> </dt>
														<dd><?php echo  htmlspecialchars($r[$i]['BREED']); ?></dd>
													<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
													</dl>
												</a>
											</li>
										<?php 
									}
									echo "</ul>";
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
								break;

							//ORGANIZATIONS
							case 'or':
								include 'php/classes/BOOrganizations.php';
								$o = new BOOrganizations;
								$r = $o->searchOrganizations($_GET['q'], 0);

								$totalRec = $o->totalRecords($_GET['q']);
								$totalPag = ceil($totalRec/28);
								
								if($r)
								{
									echo "<ul class='grid-thumbs clearfix' id='ModulesByPet'>";
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Pics']))
										{
											$thumb = 'img/organizations/thumb/'.$r[$i]['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/organizations/thumb/default.jpg';	
										}
										?>
											<li>
												<a href=<?php echo 'organizations.php?s=0&p='.$r[$i]['ID_ORGANIZATION'].'&active=6'; ?> >
													<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
														<dt>
														<?php 
															
															$name = htmlspecialchars($r[$i]['NAME']);

															if(strlen($name) == 15)
																echo substr($r[$i]['NAME'],0,14).'...' ;
															else
																echo $name;
														?> 
														</dt>
														<dd>
														<?php 

															$description = htmlspecialchars($r[$i]['DESCRIPTION']);

															if(strlen($description==35))
																echo substr($description,0,34).'...';
															else
																echo $description;
														 ?>
														</dd>
													<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
													</dl>
												</a>
											</li>
										<?php 
									}
									echo "</ul>";
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
								break;

							//PROJECTS
							case 'pr':
								include 'php/classes/BOProjects.php';
								$p = new BOProjects;
								$r = $p->searchProjects($_GET['q'],0);

								$totalRec = $p->totalRecords($_GET['q']);
								$totalPag = ceil($totalRec/28);
								
								if($r)
								{
								
									echo "<ul class='grid-thumbs clearfix' id='ModulesByPet'>";
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Albums']['Pics']) && !empty($r[$i]['Albums']['Pics']))
										{
											$thumb = 'img/projects/thumb/'.$r[$i]['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/projects/thumb/default.jpg';	
										}
										?>
											<li>
												<a href=<?php echo 'projects.php?s=0&p='.$r[$i]['ID_PROJECT'].'&active=5'; ?> >
													<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
														<dt>
														<?php 

															$title = htmlspecialchars($r[$i]['TITLE']);

															if(strlen($title) == 15)
																echo substr($title,0,14).'...' ;
															else
																echo $name;
														?> 
														</dt>
														<dd>
														<?php 
															if(strlen($description)==35)
																echo substr($description,0,34).'...';
															else
																echo $description;
														 ?>
														</dd>
													<!-- <dd><strong>Pets: </strong>Dog Cat</dd> -->
													</dl>
												</a>
											</li>
										<?php 
									}
									echo "</ul>";
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
								break;
							
							default:
								echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								break;
						}
						
					}
				?>
				
			</div><!-- scrollable menu -->
		</div> <!-- mod -->

		<!-- asd -->
		<div class="grid_4 publi-org" >
			<?php 
			//	require('admin/ledads/ad_class.php');
			//	echo $pla_class->adcode( );
			?>
		</div>

		
	</div>
	<!-- END site content -->






	<?php 
		include_once 'templates/footer.php'; 
	?>
	
</div>
<!-- END wrapper-->



<script type="text/javascript">
	//start_scroll('scrollable-module', false);
	var page = 1;
	var totalRec = <?php echo $totalRec; ?>;
	var totalPag = <?php echo $totalPag; ?>;
	$(".scrollable-module").mCustomScrollbar(
	{
		scrollButtons:
		{
			enable: false 
		},

		advanced:
		{
			updateOnContentResize: true			
		},

		theme:"light-thin",

		callbacks:
		{
		    
		    onTotalScroll:function()
		    {
	 			  		
	    		//console.log(this[0].id);// debe imprimir el id del div q tiene la clase "scroll bla bla"
	    		if(page < totalPag)
	    		{
	    			$.ajax(
		    		{
		                type: "POST",
		                url: <?php echo "'".$file."'"?>,
		                data: {q: <?php echo "'".$_GET['q']."'" ?>, from: page*28},
		                cache: false,

		                success: function(html)
		                {
		                	$('#ModulesByPet').append(html);
		                	if(page == totalPag)
					    	{

					    		$('#ModulesByPet').append('<li class="last-result">No more results</li>');
					    	} 	
		                }
		            });

			    	page++;

	    		}
	    		
	        }
		}
	});
</script>

</body>
</html>
