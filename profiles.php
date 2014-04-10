<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

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



<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 

<script type="text/javascript" src="js/lib.js"></script>

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
	
	<div id='what' >
		<a href="#"><p>What is a profile?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo htmlspecialchars($pop->getPopUps("profiles")); ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>
	<?php 
	if(isset($_GET['c'])) 
	{
	?>
		<div id="show-all">
			<a href="profiles.php">Show all profiles</a>
		</div>
	<?php } ?>

		<!-- profiles module -->
		<div id='profiles-mod' class='mod grid_12'>
			<?php 
						
				include_once 'templates/modHeader.php'; 
			?>
				
				<div class="scrollable-module" id="profiles">
					
					<ul class='grid-thumbs clearfix' id='ModulesByPet'> 
						<?php 
							
							if(!isset($_GET['c']))
							{	
								$category = '"*"';
								$url = '"ajax/searchUsers.php?"';
								
								include_once 'templates/profilesModule.php';
							}
							else
							{
								$url = '"ajax/searchUsersByPet.php?"';
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

								include 'php/classes/BOPets.php';
								$p = new BOPets;
								$r = $p->searchPetsByCategory($category, 0, 28);
								
								$totalRec = $p->totalRecords('*');
								$totalPag = ceil($totalRec/28);
								$firstPag = rand(0, $totalPag-1);
								if($r)
								{
									shuffle($r);
									
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Users']['Pics']))
										{
											$thumb = 'img/users/thumb/'.$r[$i]['Users']['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/users/thumb/default.jpg';	
										}

										if(isset($r[$i]['Cities']['City']))
										{

												$city = htmlspecialchars($r[$i]['Users']['Cities']['City']);
												$country = htmlspecialchars($r[$i]['Users']['Countries']['Country']);
										}else{
												$city = "??";
												$country = "??";

										}
										?>
											<li>
												<a href=<?php echo "user-profile.php?u=".$r[$i]['Users']['ID_USER']; ?> >
													<img src= "<?php  echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
														<dt><?php echo  htmlspecialchars($r[$i]['Users']['NAME']." ".$r[$i]['Users']['LASTNAME']); ?> </dt>
														<dd><?php echo  $city.", ".$country; ?></dd>
													 	<dd>Has <strong><?php $qty = floatval($r[$i]['COUNT']); echo $qty ?></strong> <?php if($qty == 1) echo $string; else echo $string.'s';?></dd>
													</dl>
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
		<!-- END profiles module -->

		<!-- ads -->
		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->
		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->
		<div class="publi-org mod grid_4"></div> <!-- esto hay q modificarlo -->
		<!-- END ads -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


<script type="text/javascript">
	
	//listByCategory2('searchUsersByPet.php');

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
	pages.splice(<?php echo $firstPag; ?>, 1);
	
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
		    		var li = $('.last-result');
		    		if(li.length == 0)
		    		{
		    			$('#ModulesByPet').append('<li class="last-result">No more results</li>');
		    		}
		    		
		    	}
	    		    		
	    		
	    		
	        }
		}
	});
</script>

</body>
</html>
