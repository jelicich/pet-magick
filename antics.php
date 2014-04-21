<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	


	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
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

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

</head>

<body>

<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>
<?php 
		include_once 'templates/No_IE.php'; 
?>
<div id="wrapper">
	

	<?php 
		include_once 'templates/header.php'; 
	?>


	<!-- site content -->

	<div id="content" class="container_12" >

	<div id='what' >
		<a href="#"><p>What is animal antics ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo htmlspecialchars($pop->getPopUps("antics")); ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>
		
		
		<!-- lastest videos -->
		<div id="lastest-video-mod" class="mod grid_8">
			
			<div class="mod-header">
				<h2>Latest videos</h2>
			</div>

			<ul class='mod-content clearfix videoCap'>
				<?php 
					$s = 'antics'; // esta variable define cuantas fotos habra en el modulo	
					include_once 'templates/latestVideosModule.php';
				?>
			</ul>
	

		</div>
		<!-- End lastest videos -->

		
		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->


		
		<!-- videos module -->
		<div class="mod profiles-mod animal-antics-mod grid_12 ">
			<?php 
						
				include_once 'templates/modHeaderVideos.php'; 
			?>
			<div class="scrollable-module" id="antics">
				<ul class='grid-thumbs clearfix'  id='ModulesByPet'> 
						
						<?php 
							
							if(!isset($_GET['c']))
							{	
								$category = '"*"';
								$url = '"ajax/searchAntics.php?"'; 
								
								include_once 'templates/anticsModule.php'; 
							}
							else
							{
								$url = '"ajax/searchAnticsByCategory.php?"'; 
								switch ($_GET['c']) 
								{
									case 'dog':
										$category = 1;
										$string = 'dog';									
										break;

									case 'cat':
										$category = 2;
										$string = 'cat';
										break;

									case 'bird':
										$category = 3;
										$string = 'bird';
										break;

									case 'rabbit':
										$category = 4;
										$string = 'rabbit';
										break;

									case 'ferret':
										$category = 5;
										$string = 'cat';
										break;

									case 'others':
										$category = 6;
										$string = 'pet';
										break;
									
									default:
										$category = 1;
										$string = 'dog';
										break;									
								}

								//include 'php/classes/BOVideos.php';
								$p = new BOVideos;
								$r = $p->searchVideosByCategory($category, 0, 28);

								$totalRec = $p->totalRecords('*');
								$totalPag = ceil($totalRec/28);
								$firstPag = rand(0, $totalPag-1);

								if($r)
								{
									shuffle($r);
									
									for($i = 0; $i < sizeof($r); $i++)
									{
										
											$thumb = 'video/'.$r[$i]["THUMBNAIL"]; 
											$title = $r[$i]["TITLE"]; 
											$caption = $r[$i]["CAPTION"]; 
											$srcVideo = 'video/'.$r[$i]['VIDEO']; 

										?>
											<li class="ie-play  videoMin">
												<a class="petVideo" href= <?php  echo $srcVideo; ?> >
													
													<span class='wrapper-play'>
														
														<span class="play"></span>
														
															<img src= <?php  echo $thumb; ?> class='thumb-mid'/>

															<dl class='hidden'>
																<dt><?php echo htmlspecialchars($title); ?> </dt>
																<dd><?php echo  htmlspecialchars($caption); ?></dd>
															<!-- <dd><strong>Videos: </strong>Dog Cat</dd> -->
															</dl>

													</span>
												</a>
											</li>
										<?php 
									}
									
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
							}
						?>
				</ul>	
			</div>
		</div>
		<!-- END video module -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


	<?php 
		include_once 'templates/player.php'; 
	?>
	
<script type="text/javascript">
	
	video();
	//listByCategory('anticsModuleByCategory.php');
	//start_scroll('scrollable-module', false);

	function range(start, end) 
	{
	    var foo = [];
	    for (var i = start; i <= end; i++) {
	        foo.push(i);
	    }
	    return foo;
	}
	
	//Guardo la cant de pags en un array
	var pages = range(0, <?php echo $totalPag ?>);
	//borro la primer pag q se imprime del array (la primera vez q se ejecuta nro de pag coincide con indice de array)
	pages.splice(<?php echo $firstPag ?>, 1);
	
	var totalRec = <?php if($totalRec) echo $totalRec; else echo "0"; ?>;
	var totalPag = <?php if($totalPag) echo $totalPag; else echo "0"; ?>;

	$(".scrollable-module").mCustomScrollbar(
	{
		scrollButtons:
		{
			enable: false 
		},

		advanced:
		{
			updateOnContentResize: true,
			horizontalSrcoll: true
		},

		theme:"light-thin",

		callbacks:
		{
		    
		    onTotalScroll:function()
		    {
	 			  		
	    		
	    		if(pages.length > 0)
	    		{
	    			//agarro una pag random del array
	    			var rand = Math.floor(Math.random() * pages.length);
		    		page = pages[rand];

		    		$.ajax(
		    		{
		                type: "POST",
		                url: <?php echo $url ?>,
		                data: {q: <?php echo $category ?>, from: page*28, rand: true},
		                cache: false,

		                success: function(html)
		                {
		                	$('#ModulesByPet').append(html);		                	
		                }
		            });			    	

	    		

		    		//borro la pag q se cargo del array
		    		pages.splice(rand,1);		    		

	    		}

	    		else
		    	{
		    		var li = $('.last-result-tributes');
		    		if(li.length == 0)
		    		{
		    			$('#ModulesByPet').append('<li class="last-result-tributes">No more results</li>');
		    		}
		    		
		    	}
	    		    		
	    		
	    		
	        }
		}
	});

</script>


</body>
</html>
